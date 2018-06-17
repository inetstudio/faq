<?php

namespace InetStudio\FAQ\Tags\Services\Back;

use League\Fractal\Manager;
use Illuminate\Support\Facades\Session;
use InetStudio\FAQ\Tags\Contracts\Models\TagModelContract;
use InetStudio\FAQ\Tags\Contracts\Services\Back\TagsServiceContract;
use InetStudio\FAQ\Tags\Contracts\Repositories\TagsRepositoryContract;
use InetStudio\FAQ\Tags\Contracts\Http\Requests\Back\SaveTagRequestContract;

/**
 * Class TagsService.
 */
class TagsService implements TagsServiceContract
{
    /**
     * @var TagsRepositoryContract
     */
    private $repository;

    /**
     * TagsService constructor.
     *
     * @param TagsRepositoryContract $repository
     */
    public function __construct(TagsRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Получаем объект модели.
     *
     * @param int $id
     *
     * @return TagModelContract
     */
    public function getTagObject(int $id = 0)
    {
        return $this->repository->getItemByID($id);
    }

    /**
     * Получаем объекты по списку id.
     *
     * @param array|int $ids
     * @param array $extColumns
     * @param array $with
     * @param bool $returnBuilder
     *
     * @return mixed
     */
    public function getTagsByIDs($ids, array $extColumns = [], array $with = [], bool $returnBuilder = false)
    {
        return $this->repository->getItemsByIDs($ids, $extColumns, $with, $returnBuilder);
    }

    /**
     * Сохраняем модель.
     *
     * @param SaveTagRequestContract $request
     * @param int $id
     *
     * @return TagModelContract
     */
    public function save(SaveTagRequestContract $request, int $id): TagModelContract
    {
        $action = ($id) ? 'отредактирован' : 'создан';
        $item = $this->repository->save($request->only($this->repository->getModel()->getFillable()), $id);

        event(app()->makeWith('InetStudio\FAQ\Tags\Contracts\Events\Back\ModifyTagEventContract', [
            'object' => $item,
        ]));

        Session::flash('success', 'Тег «'.$item->name.'» успешно '.$action);

        return $item;
    }

    /**
     * Удаляем модель.
     *
     * @param $id
     *
     * @return bool
     */
    public function destroy(int $id): ?bool
    {
        return $this->repository->destroy($id);
    }

    /**
     * Получаем подсказки.
     *
     * @param string $search
     * @param string $type
     * @param array $extColumns
     * @param array $with
     * @param bool $returnBuilder
     *
     * @return array
     */
    public function getSuggestions(string $search, string $type, array $extColumns = [], array $with = [], bool $returnBuilder = false): array
    {
        $items = $this->repository->searchItems([['name', 'LIKE', '%'.$search.'%']], $extColumns, $with, $returnBuilder);

        $resource = (app()->makeWith('InetStudio\FAQ\Tags\Contracts\Transformers\Back\SuggestionTransformerContract', [
            'type' => $type,
        ]))->transformCollection($items);

        $manager = new Manager();
        $manager->setSerializer(app()->make('InetStudio\AdminPanel\Contracts\Serializers\SimpleDataArraySerializerContract'));

        $transformation = $manager->createData($resource)->toArray();

        if ($type && $type == 'autocomplete') {
            $data['suggestions'] = $transformation;
        } else {
            $data['items'] = $transformation;
        }

        return $data;
    }

    /**
     * Присваиваем теги объекту.
     *
     * @param $request
     *
     * @param $item
     */
    public function attachToObject($request, $item)
    {
        if ($request->filled('tags')) {
            $item->syncTags($this->repository->getItemsByIDs((array) $request->get('tags')));
        } else {
            $item->detachTags($item->tags);
        }
    }
}
