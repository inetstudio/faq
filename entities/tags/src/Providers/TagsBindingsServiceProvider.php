<?php

namespace InetStudio\FAQ\Tags\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class TagsBindingsServiceProvider.
 */
class TagsBindingsServiceProvider extends ServiceProvider
{
    /**
    * @var  bool
    */
    protected $defer = true;

    /**
    * @var  array
    */
    public $bindings = [
        'InetStudio\FAQ\Tags\Contracts\Events\Back\ModifyTagEventContract' => 'InetStudio\FAQ\Tags\Events\Back\ModifyTagEvent',
        'InetStudio\FAQ\Tags\Contracts\Http\Controllers\Back\TagsControllerContract' => 'InetStudio\FAQ\Tags\Http\Controllers\Back\TagsController',
        'InetStudio\FAQ\Tags\Contracts\Http\Controllers\Back\TagsDataControllerContract' => 'InetStudio\FAQ\Tags\Http\Controllers\Back\TagsDataController',
        'InetStudio\FAQ\Tags\Contracts\Http\Controllers\Back\TagsUtilityControllerContract' => 'InetStudio\FAQ\Tags\Http\Controllers\Back\TagsUtilityController',
        'InetStudio\FAQ\Tags\Contracts\Http\Requests\Back\SaveTagRequestContract' => 'InetStudio\FAQ\Tags\Http\Requests\Back\SaveTagRequest',
        'InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Tags\DestroyResponseContract' => 'InetStudio\FAQ\Tags\Http\Responses\Back\Tags\DestroyResponse',
        'InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Tags\FormResponseContract' => 'InetStudio\FAQ\Tags\Http\Responses\Back\Tags\FormResponse',
        'InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Tags\IndexResponseContract' => 'InetStudio\FAQ\Tags\Http\Responses\Back\Tags\IndexResponse',
        'InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Tags\SaveResponseContract' => 'InetStudio\FAQ\Tags\Http\Responses\Back\Tags\SaveResponse',
        'InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Tags\ShowResponseContract' => 'InetStudio\FAQ\Tags\Http\Responses\Back\Tags\ShowResponse',
        'InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract' => 'InetStudio\FAQ\Tags\Http\Responses\Back\Utility\SuggestionsResponse',
        'InetStudio\FAQ\Tags\Contracts\Models\TaggableModelContract' => 'InetStudio\FAQ\Tags\Models\TaggableModel',
        'InetStudio\FAQ\Tags\Contracts\Models\TagModelContract' => 'InetStudio\FAQ\Tags\Models\TagModel',
        'InetStudio\FAQ\Tags\Contracts\Repositories\TaggablesRepositoryContract' => 'InetStudio\FAQ\Tags\Repositories\TaggablesRepository',
        'InetStudio\FAQ\Tags\Contracts\Repositories\TagsRepositoryContract' => 'InetStudio\FAQ\Tags\Repositories\TagsRepository',
        'InetStudio\FAQ\Tags\Contracts\Services\Back\TagsDataTableServiceContract' => 'InetStudio\FAQ\Tags\Services\Back\TagsDataTableService',
        'InetStudio\FAQ\Tags\Contracts\Services\Back\TagsServiceContract' => 'InetStudio\FAQ\Tags\Services\Back\TagsService',
        'InetStudio\FAQ\Tags\Contracts\Services\Front\TagsServiceContract' => 'InetStudio\FAQ\Tags\Services\Front\TagsService',
        'InetStudio\FAQ\Tags\Contracts\Transformers\Back\SuggestionTransformerContract' => 'InetStudio\FAQ\Tags\Transformers\Back\SuggestionTransformer',
        'InetStudio\FAQ\Tags\Contracts\Transformers\Back\TagTransformerContract' => 'InetStudio\FAQ\Tags\Transformers\Back\TagTransformer',
    ];

    /**
     * Получить сервисы от провайдера.
     *
     * @return  array
     */
    public function provides()
    {
        return array_keys($this->bindings);
    }
}
