<?php

namespace InetStudio\FAQ\Questions\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Utility\ActivityResponseContract;
use InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract;
use InetStudio\FAQ\Questions\Contracts\Http\Controllers\Back\QuestionsUtilityControllerContract;

/**
 * Class QuestionsUtilityController.
 */
class QuestionsUtilityController extends Controller implements QuestionsUtilityControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * QuestionsUtilityController constructor.
     */
    public function __construct()
    {
        $this->services['questions'] = app()->make(
            'InetStudio\FAQ\Questions\Contracts\Services\Back\QuestionsServiceContract'
        );
    }

    /**
     * Возвращаем объекты для поля.
     *
     * @param Request $request
     *
     * @return SuggestionsResponseContract
     */
    public function getSuggestions(Request $request): SuggestionsResponseContract
    {
        $search = $request->get('q');
        $type = $request->get('type') ?? '';

        $suggestions = $this->services['questions']->getSuggestions($search, $type);

        return app()->makeWith(
            SuggestionsResponseContract::class,
            compact('suggestions')
        );
    }

    /**
     * Изменяем активность объекта.
     *
     * @param $id
     *
     * @return ActivityResponseContract
     */
    public function changeActivity(int $id): ActivityResponseContract
    {
        $this->services['questions']->changeActivity($id);
        $item = $this->services['questions']->setRead($id);

        return app()->makeWith(ActivityResponseContract::class, [
            'item' => $item,
        ]);
    }
}
