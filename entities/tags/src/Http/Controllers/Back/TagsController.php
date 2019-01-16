<?php

namespace InetStudio\FAQ\Tags\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use InetStudio\FAQ\Tags\Contracts\Http\Requests\Back\SaveTagRequestContract;
use InetStudio\FAQ\Tags\Contracts\Http\Controllers\Back\TagsControllerContract;
use InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Tags\FormResponseContract;
use InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Tags\SaveResponseContract;
use InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Tags\ShowResponseContract;
use InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Tags\IndexResponseContract;
use InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Tags\DestroyResponseContract;

/**
 * Class TagsController.
 */
class TagsController extends Controller implements TagsControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    public $services;

    /**
     * TagsController constructor.
     */
    public function __construct()
    {
        $this->services['tags'] = app()->make('InetStudio\FAQ\Tags\Contracts\Services\Back\TagsServiceContract');
        $this->services['dataTables'] = app()->make('InetStudio\FAQ\Tags\Contracts\Services\Back\TagsDataTableServiceContract');
    }

    /**
     * Список объектов.
     *
     * @return IndexResponseContract
     */
    public function index(): IndexResponseContract
    {
        $table = $this->services['dataTables']->html();

        return app()->makeWith('InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Tags\IndexResponseContract', [
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
        $item = $this->services['tags']->getTagObject($id);

        return app()->makeWith('InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Tags\IndexResponseContract', [
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
        $item = $this->services['tags']->getTagObject();

        return app()->makeWith('InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Tags\FormResponseContract', [
            'data' => compact('item'),
        ]);
    }

    /**
     * Создание объекта.
     *
     * @param SaveTagRequestContract $request
     *
     * @return SaveResponseContract
     */
    public function store(SaveTagRequestContract $request): SaveResponseContract
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
    public function edit(int $id = 0): FormResponseContract
    {
        $item = $this->services['tags']->getTagObject($id);

        return app()->makeWith('InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Tags\FormResponseContract', [
            'data' => compact('item'),
        ]);
    }

    /**
     * Обновление объекта.
     *
     * @param SaveTagRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    public function update(SaveTagRequestContract $request, int $id = 0): SaveResponseContract
    {
        return $this->save($request, $id);
    }

    /**
     * Сохранение объекта.
     *
     * @param SaveTagRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    protected function save(SaveTagRequestContract $request, int $id = 0): SaveResponseContract
    {
        $item = $this->services['tags']->save($request, $id);

        return app()->makeWith('InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Tags\SaveResponseContract', [
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
        $result = $this->services['tags']->destroy($id);

        return app()->makeWith('InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Tags\DestroyResponseContract', [
            'result' => (!! $result === null),
        ]);
    }
}
