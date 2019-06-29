<?php

namespace InetStudio\FAQ\Tags\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * Class BindingsServiceProvider.
 */
class BindingsServiceProvider extends BaseServiceProvider implements DeferrableProvider
{
    /**
     * @var array
     */
    public $bindings = [
        'InetStudio\FAQ\Tags\Contracts\Events\Back\ModifyItemEventContract' => 'InetStudio\FAQ\Tags\Events\Back\ModifyItemEvent',
        'InetStudio\FAQ\Tags\Contracts\Http\Controllers\Back\ResourceControllerContract' => 'InetStudio\FAQ\Tags\Http\Controllers\Back\ResourceController',
        'InetStudio\FAQ\Tags\Contracts\Http\Controllers\Back\DataControllerContract' => 'InetStudio\FAQ\Tags\Http\Controllers\Back\DataController',
        'InetStudio\FAQ\Tags\Contracts\Http\Controllers\Back\UtilityControllerContract' => 'InetStudio\FAQ\Tags\Http\Controllers\Back\UtilityController',
        'InetStudio\FAQ\Tags\Contracts\Http\Requests\Back\SaveItemRequestContract' => 'InetStudio\FAQ\Tags\Http\Requests\Back\SaveItemRequest',
        'InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Resource\DestroyResponseContract' => 'InetStudio\FAQ\Tags\Http\Responses\Back\Resource\DestroyResponse',
        'InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Resource\FormResponseContract' => 'InetStudio\FAQ\Tags\Http\Responses\Back\Resource\FormResponse',
        'InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Resource\IndexResponseContract' => 'InetStudio\FAQ\Tags\Http\Responses\Back\Resource\IndexResponse',
        'InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Resource\SaveResponseContract' => 'InetStudio\FAQ\Tags\Http\Responses\Back\Resource\SaveResponse',
        'InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Resource\ShowResponseContract' => 'InetStudio\FAQ\Tags\Http\Responses\Back\Resource\ShowResponse',
        'InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract' => 'InetStudio\FAQ\Tags\Http\Responses\Back\Utility\SuggestionsResponse',
        'InetStudio\FAQ\Tags\Contracts\Models\TaggableModelContract' => 'InetStudio\FAQ\Tags\Models\TaggableModel',
        'InetStudio\FAQ\Tags\Contracts\Models\TagModelContract' => 'InetStudio\FAQ\Tags\Models\TagModel',
        'InetStudio\FAQ\Tags\Contracts\Services\Back\DataTableServiceContract' => 'InetStudio\FAQ\Tags\Services\Back\DataTableService',
        'InetStudio\FAQ\Tags\Contracts\Services\Back\ItemsServiceContract' => 'InetStudio\FAQ\Tags\Services\Back\ItemsService',
        'InetStudio\FAQ\Tags\Contracts\Services\Back\UtilityServiceContract' => 'InetStudio\FAQ\Tags\Services\Back\UtilityService',
        'InetStudio\FAQ\Tags\Contracts\Services\Front\ItemsServiceContract' => 'InetStudio\FAQ\Tags\Services\Front\ItemsService',
        'InetStudio\FAQ\Tags\Contracts\Transformers\Back\Utility\SuggestionTransformerContract' => 'InetStudio\FAQ\Tags\Transformers\Back\Utility\SuggestionTransformer',
        'InetStudio\FAQ\Tags\Contracts\Transformers\Back\Resource\IndexTransformerContract' => 'InetStudio\FAQ\Tags\Transformers\Back\Resource\IndexTransformer',
    ];

    /**
     * Получить сервисы от провайдера.
     *
     * @return array
     */
    public function provides()
    {
        return array_keys($this->bindings);
    }
}
