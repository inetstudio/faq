<?php

namespace InetStudio\FAQ\Questions\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use InetStudio\FAQ\Questions\Contracts\Http\Responses\Front\SaveResponseContract;
use InetStudio\FAQ\Questions\Contracts\Http\Requests\Front\SaveQuestionRequestContract;
use InetStudio\FAQ\Questions\Contracts\Http\Controllers\Front\QuestionsControllerContract;

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
    public $services;

    /**
     * QuestionsController constructor.
     */
    public function __construct()
    {
        $this->services['questions'] = app()->make(
            'InetStudio\FAQ\Questions\Contracts\Services\Front\QuestionsServiceContract'
        );
    }

    /**
     * Сохранение объекта.
     *
     * @param SaveQuestionRequestContract $request
     *
     * @return SaveResponseContract
     */
    public function save(SaveQuestionRequestContract $request): SaveResponseContract
    {
        $result = $this->services['questions']->save($request->all());

        return app()->makeWith(SaveResponseContract::class, [
            'result' => $result,
        ]);
    }
}
