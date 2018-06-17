<?php

namespace InetStudio\FAQ\Questions\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use InetStudio\FAQ\Questions\Contracts\Http\Requests\Back\SaveQuestionRequestContract;
use InetStudio\FAQ\Questions\Contracts\Http\Controllers\Back\QuestionsControllerContract;
use InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Questions\FormResponseContract;
use InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Questions\SaveResponseContract;
use InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Questions\ShowResponseContract;
use InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Questions\IndexResponseContract;
use InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Questions\DestroyResponseContract;

/**
 * Class QuestionsController.
 */
class QuestionsController extends Controller implements QuestionsControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * QuestionsController constructor.
     */
    public function __construct()
    {
        $this->services['questions'] = app()->make(
            'InetStudio\FAQ\Questions\Contracts\Services\Back\QuestionsServiceContract'
        );

        $this->services['dataTables'] = app()->make(
            'InetStudio\FAQ\Questions\Contracts\Services\Back\QuestionsDataTableServiceContract'
        );
    }

    /**
     * Список объектов.
     *
     * @return IndexResponseContract
     */
    public function index(): IndexResponseContract
    {
        $table = $this->services['dataTables']->html();

        return app()->makeWith(IndexResponseContract::class, [
            'data' => compact('table'),
        ]);
    }

    /**
     * Получение объекта.
     *
     * @param int $id
     *
     * @return ShowResponseContract
     */
    public function show(int $id = 0): ShowResponseContract
    {
        $item = $this->services['questions']->getQuestionObject($id);

        return app()->makeWith(ShowResponseContract::class, [
            'item' => $item,
        ]);
    }

    /**
     * Добавление объекта.
     *
     * @return FormResponseContract
     */
    public function create(): FormResponseContract
    {
        $item = $this->services['questions']->getQuestionObject();

        return app()->makeWith(FormResponseContract::class, [
            'data' => compact('item'),
        ]);
    }

    /**
     * Создание объекта.
     *
     * @param SaveQuestionRequestContract $request
     *
     * @return SaveResponseContract
     */
    public function store(SaveQuestionRequestContract $request): SaveResponseContract
    {
        return $this->save($request);
    }

    /**
     * Редактирование объекта.
     *
     * @param int $id
     *
     * @return FormResponseContract
     */
    public function edit($id = 0): FormResponseContract
    {
        $item = $this->services['questions']->setRead($id);

        return app()->makeWith(FormResponseContract::class, [
            'data' => compact('item'),
        ]);
    }

    /**
     * Обновление объекта.
     *
     * @param SaveQuestionRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    public function update(SaveQuestionRequestContract $request, int $id = 0): SaveResponseContract
    {
        return $this->save($request, $id);
    }

    /**
     * Сохранение объекта.
     *
     * @param SaveQuestionRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    private function save(SaveQuestionRequestContract $request, int $id = 0): SaveResponseContract
    {
        $item = $this->services['questions']->save($request, $id);

        return app()->makeWith(SaveResponseContract::class, [
            'item' => $item,
        ]);
    }

    /**
     * Удаление объекта.
     *
     * @param int $id
     *
     * @return DestroyResponseContract
     */
    public function destroy(int $id = 0): DestroyResponseContract
    {
        $result = $this->services['questions']->destroy($id);

        return app()->makeWith(DestroyResponseContract::class, [
            'result' => ($result === null) ? false : $result,
        ]);
    }
}
