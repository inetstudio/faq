<?php

namespace InetStudio\FAQ\Questions\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

/**
 * Class BindingsServiceProvider.
 */
class BindingsServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * @var  array
     */
    public $bindings = [
        'InetStudio\FAQ\Questions\Contracts\Events\Back\ModifyItemActivityEventContract' => 'InetStudio\FAQ\Questions\Events\Back\ModifyItemActivityEvent',
        'InetStudio\FAQ\Questions\Contracts\Events\Back\ModifyItemEventContract' => 'InetStudio\FAQ\Questions\Events\Back\ModifyItemEvent',
        'InetStudio\FAQ\Questions\Contracts\Events\Front\SendItemEventContract' => 'InetStudio\FAQ\Questions\Events\Front\SendItemEvent',
        'InetStudio\FAQ\Questions\Contracts\Exports\ItemsExportContract' => 'InetStudio\FAQ\Questions\Exports\ItemsExport',
        'InetStudio\FAQ\Questions\Contracts\Http\Controllers\Back\ResourceControllerContract' => 'InetStudio\FAQ\Questions\Http\Controllers\Back\ResourceController',
        'InetStudio\FAQ\Questions\Contracts\Http\Controllers\Back\DataControllerContract' => 'InetStudio\FAQ\Questions\Http\Controllers\Back\DataController',
        'InetStudio\FAQ\Questions\Contracts\Http\Controllers\Back\ExportControllerContract' => 'InetStudio\FAQ\Questions\Http\Controllers\Back\ExportController',
        'InetStudio\FAQ\Questions\Contracts\Http\Controllers\Back\ModerateControllerContract' => 'InetStudio\FAQ\Questions\Http\Controllers\Back\ModerateController',
        'InetStudio\FAQ\Questions\Contracts\Http\Controllers\Back\UtilityControllerContract' => 'InetStudio\FAQ\Questions\Http\Controllers\Back\UtilityController',
        'InetStudio\FAQ\Questions\Contracts\Http\Controllers\Front\ItemsControllerContract' => 'InetStudio\FAQ\Questions\Http\Controllers\Front\ItemsController',
        'InetStudio\FAQ\Questions\Contracts\Http\Requests\Back\SaveItemRequestContract' => 'InetStudio\FAQ\Questions\Http\Requests\Back\SaveItemRequest',
        'InetStudio\FAQ\Questions\Contracts\Http\Requests\Front\SaveItemRequestContract' => 'InetStudio\FAQ\Questions\Http\Requests\Front\SaveItemRequest',
        'InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Moderate\DestroyResponseContract' => 'InetStudio\FAQ\Questions\Http\Responses\Back\Moderate\DestroyResponse',
        'InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Moderate\ReadResponseContract' => 'InetStudio\FAQ\Questions\Http\Responses\Back\Moderate\ReadResponse',
        'InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Moderate\ActivityResponseContract' => 'InetStudio\FAQ\Questions\Http\Responses\Back\Moderate\ActivityResponse',
        'InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Resource\DestroyResponseContract' => 'InetStudio\FAQ\Questions\Http\Responses\Back\Resource\DestroyResponse',
        'InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Resource\FormResponseContract' => 'InetStudio\FAQ\Questions\Http\Responses\Back\Resource\FormResponse',
        'InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Resource\IndexResponseContract' => 'InetStudio\FAQ\Questions\Http\Responses\Back\Resource\IndexResponse',
        'InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Resource\SaveResponseContract' => 'InetStudio\FAQ\Questions\Http\Responses\Back\Resource\SaveResponse',
        'InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Resource\ShowResponseContract' => 'InetStudio\FAQ\Questions\Http\Responses\Back\Resource\ShowResponse',
        'InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract' => 'InetStudio\FAQ\Questions\Http\Responses\Back\Utility\SuggestionsResponse',
        'InetStudio\FAQ\Questions\Contracts\Http\Responses\Front\SaveResponseContract' => 'InetStudio\FAQ\Questions\Http\Responses\Front\SaveResponse',
        'InetStudio\FAQ\Questions\Contracts\Listeners\SendEmailToPersonListenerContract' => 'InetStudio\FAQ\Questions\Listeners\SendEmailToPersonListener',
        'InetStudio\FAQ\Questions\Contracts\Listeners\SendEmailToUserListenerContract' => 'InetStudio\FAQ\Questions\Listeners\SendEmailToUserListener',
        'InetStudio\FAQ\Questions\Contracts\Mail\Back\AnswerMailContract' => 'InetStudio\FAQ\Questions\Mail\Back\AnswerMail',
        'InetStudio\FAQ\Questions\Contracts\Mail\Front\NewItemMailContract' => 'InetStudio\FAQ\Questions\Mail\Front\NewItemMail',
        'InetStudio\FAQ\Questions\Contracts\Models\QuestionModelContract' => 'InetStudio\FAQ\Questions\Models\QuestionModel',
        'InetStudio\FAQ\Questions\Contracts\Notifications\Back\AnswerNotificationContract' => 'InetStudio\FAQ\Questions\Notifications\Back\AnswerNotification',
        'InetStudio\FAQ\Questions\Contracts\Notifications\Back\AnswerQueueableNotificationContract' => 'InetStudio\FAQ\Questions\Notifications\Back\AnswerQueueableNotification',
        'InetStudio\FAQ\Questions\Contracts\Notifications\Front\NewItemNotificationContract' => 'InetStudio\FAQ\Questions\Notifications\Front\NewItemNotification',
        'InetStudio\FAQ\Questions\Contracts\Notifications\Front\NewItemQueueableNotificationContract' => 'InetStudio\FAQ\Questions\Notifications\Front\NewItemQueueableNotification',
        'InetStudio\FAQ\Questions\Contracts\Services\Back\DataTableServiceContract' => 'InetStudio\FAQ\Questions\Services\Back\DataTableService',
        'InetStudio\FAQ\Questions\Contracts\Services\Back\ItemsServiceContract' => 'InetStudio\FAQ\Questions\Services\Back\ItemsService',
        'InetStudio\FAQ\Questions\Contracts\Services\Back\ModerateServiceContract' => 'InetStudio\FAQ\Questions\Services\Back\ModerateService',
        'InetStudio\FAQ\Questions\Contracts\Services\Back\UtilityServiceContract' => 'InetStudio\FAQ\Questions\Services\Back\UtilityService',
        'InetStudio\FAQ\Questions\Contracts\Services\Front\ItemsServiceContract' => 'InetStudio\FAQ\Questions\Services\Front\ItemsService',
        'InetStudio\FAQ\Questions\Contracts\Transformers\Back\Resource\IndexTransformerContract' => 'InetStudio\FAQ\Questions\Transformers\Back\Resource\IndexTransformer',
        'InetStudio\FAQ\Questions\Contracts\Transformers\Back\Utility\SuggestionTransformerContract' => 'InetStudio\FAQ\Questions\Transformers\Back\Utility\SuggestionTransformer',
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
