<?php

namespace InetStudio\FAQ\Questions\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use InetStudio\FAQ\Questions\Contracts\Http\Controllers\Back\QuestionsDataControllerContract;

/**
 * Class QuestionsDataController.
 */
class QuestionsDataController extends Controller implements QuestionsDataControllerContract
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
        $this->services['dataTables'] = app()->make('InetStudio\FAQ\Questions\Contracts\Services\Back\QuestionsDataTableServiceContract');
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
