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
     * @param array $params
     *
     * @return mixed
     */
    public function getTagsByIDs($ids, array $params = [])
    {
        return $this->repository->getItemsByIDs($ids, $params);
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
     *
     * @return array
     */
    public function getSuggestions(string $search, string $type): array
    {
        $items = $this->repository->searchItems([['title', 'LIKE', '%'.$search.'%']]);

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
