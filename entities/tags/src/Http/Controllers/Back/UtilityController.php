<?php

namespace InetStudio\FAQ\Tags\Http\Controllers\Back;

use Illuminate\Http\Request;
use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\FAQ\Tags\Contracts\Services\Back\UtilityServiceContract;
use InetStudio\FAQ\Tags\Contracts\Http\Controllers\Back\UtilityControllerContract;
use InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract;

/**
 * Class UtilityController.
 */
class UtilityController extends Controller implements UtilityControllerContract
{
    /**
     * Возвращаем объекты для поля.
     *
     * @param  UtilityServiceContract  $utilityService
     * @param  Request  $request
     *
     * @return SuggestionsResponseContract
     *
     * @throws BindingResolutionException
     */
    public function getSuggestions(UtilityServiceContract $utilityService, Request $request): SuggestionsResponseContract
    {
        $search = $request->get('q', '') ?? '';
        $type = $request->get('type', '') ?? '';

        $items = $utilityService->getSuggestions($search);

        return $this->app->make(SuggestionsResponseContract::class, compact('items', 'type'));
    }
}
