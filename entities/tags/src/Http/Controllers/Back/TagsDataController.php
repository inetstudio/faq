<?php

namespace InetStudio\FAQ\Tags\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use InetStudio\FAQ\Tags\Contracts\Http\Controllers\Back\TagsDataControllerContract;

/**
 * Class TagsDataController.
 */
class TagsDataController extends Controller implements TagsDataControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * TagsController constructor.
     */
    public function __construct()
    {
        $this->services['dataTables'] = app()->make('InetStudio\FAQ\Tags\Contracts\Services\Back\TagsDataTableServiceContract');
    }

    /**
     * Получаем данные для отображения в таблице.
     *
     * @return mixed
     */
    public function data()
    {
        return $this->services['dataTables']->ajax();
    }
}
