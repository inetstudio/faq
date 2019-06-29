<?php

namespace InetStudio\FAQ\Tags\Contracts\Http\Controllers\Back;

use Illuminate\Http\Request;
use InetStudio\FAQ\Tags\Contracts\Services\Back\UtilityServiceContract;
use InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract;

/**
 * Interface UtilityControllerContract.
 */
interface UtilityControllerContract
{
    /**
     * Возвращаем объекты для поля.
     *
     * @param  UtilityServiceContract  $utilityService
     * @param  Request  $request
     *
     * @return SuggestionsResponseContract
     */
    public function getSuggestions(UtilityServiceContract $utilityService, Request $request): SuggestionsResponseContract;
}
