<?php

namespace InetStudio\FAQ\Questions\Services\Back;

use League\Fractal\Manager;
use Illuminate\Support\Facades\Session;
use InetStudio\FAQ\Questions\Contracts\Models\QuestionModelContract;
use InetStudio\FAQ\Questions\Contracts\Services\Back\QuestionsServiceContract;
use InetStudio\FAQ\Questions\Contracts\Repositories\QuestionsRepositoryContract;
use InetStudio\FAQ\Questions\Contracts\Http\Requests\Back\SaveQuestionRequestContract;

/**
 * Class QuestionsService.
 */
class QuestionsService implements QuestionsServiceContract
{
    /**
     * @var QuestionsRepositoryContract
     */
    private $repository;

    /**
     * QuestionsService constructor.
     *
     * @param QuestionsRepositoryContract $repository
     */
    public function __construct(QuestionsRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Получаем объект модели.
     *
     * @param int $id
     *
     * @return QuestionModelContract
     */
    public function getQuestionObject(int $id = 0): QuestionModelContract
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
    public function getQuestionsByIDs($ids, array $extColumns = [], array $with = [], bool $returnBuilder = false)
    {
        return $this->repository->getItemsByIDs($ids, $extColumns, $with, $returnBuilder);
    }

    /**
     * Сохраняем модель.
     *
     * @param SaveQuestionRequestContract $request
     * @param int $id
     *
     * @return QuestionModelContract
     */
    public function save(SaveQuestionRequestContract $request, int $id): QuestionModelContract
    {
        $action = ($id) ? 'отредактирован' : 'создан';
        $item = $this->repository->save($request->only($this->repository->getModel()->getFillable()), $id);

        $images = (config('faq_questions.images.conversions.question')) ? array_keys(config('faq_questions.images.conversions.question')) : [];
        app()->make('InetStudio\Uploads\Contracts\Services\Back\ImagesServiceContract')
            ->attachToObject($request, $item, $images, 'faq_questions', 'question');

        app()->make('InetStudio\FAQ\Tags\Contracts\Services\Back\TagsServiceContract')
            ->attachToObject($request, $item);

        app()->make('InetStudio\Classifiers\Contracts\Services\Back\ClassifiersServiceContract')
            ->attachToObject($request, $item);

        app()->make('InetStudio\Persons\Contracts\Services\Back\PersonsServiceContract')
            ->attachToObject($request, $item);

        $item->searchable();

        event(app()->makeWith('InetStudio\FAQ\Questions\Contracts\Events\Back\ModifyQuestionEventContract', [
            'object' => $item,
        ]));

        Session::flash('success', 'Вопрос успешно '.$action);

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
        $items = $this->repository->searchItems([['question', 'LIKE', '%'.$search.'%']], $extColumns, $with, $returnBuilder);

        $resource = (app()->makeWith('InetStudio\FAQ\Questions\Contracts\Transformers\Back\SuggestionTransformerContract', [
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
     * Изменяем активность объекта.
     *
     * @param int $id
     *
     * @return QuestionModelContract
     */
    public function changeActivity(int $id): QuestionModelContract
    {
        $item = $this->getQuestionObject($id);

        $item = (! $item->id) ? $item : $this->repository->save([
            'is_active' => ! $item->is_active,
        ], $id);

        event(app()->makeWith('InetStudio\FAQ\Questions\Contracts\Events\Back\ModifyQuestionEventContract', [
            'object' => $item,
        ]));

        return $item;
    }

    /**
     * Помечаем объект просмотренным.
     *
     * @param int $id
     *
     * @return QuestionModelContract
     */
    public function setRead(int $id): QuestionModelContract
    {
        $item = $this->getQuestionObject($id);

        $item = (! $item->id) ? $item : $this->repository->save([
            'is_read' => 1,
        ], $item->id);

        return $item;
    }
}
