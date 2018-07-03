<?php

namespace InetStudio\FAQ\Tags\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use InetStudio\FAQ\Tags\Contracts\Http\Controllers\Back\TagsUtilityControllerContract;
use InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract;

/**
 * Class TagsUtilityController.
 */
class TagsUtilityController extends Controller implements TagsUtilityControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    public $services;

    /**
     * MessagesController constructor.
     */
    public function __construct()
    {
        $this->services['tags'] = app()->make(
            'InetStudio\FAQ\Tags\Contracts\Services\Back\TagsServiceContract'
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

        $suggestions = $this->services['tags']->getSuggestions($search, $type);

        return app()->makeWith(
            'InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract',
            compact('suggestions')
        );
    }
}
