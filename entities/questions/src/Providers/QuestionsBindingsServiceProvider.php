<?php

namespace InetStudio\FAQ\Questions\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class QuestionsBindingsServiceProvider.
 */
class QuestionsBindingsServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public $bindings = [
        // Controllers
        'InetStudio\FAQ\Questions\Contracts\Http\Controllers\Back\QuestionsControllerContract' => 'InetStudio\FAQ\Questions\Http\Controllers\Back\QuestionsController',
        'InetStudio\FAQ\Questions\Contracts\Http\Controllers\Back\QuestionsDataControllerContract' => 'InetStudio\FAQ\Questions\Http\Controllers\Back\QuestionsDataController',
        'InetStudio\FAQ\Questions\Contracts\Http\Controllers\Back\QuestionsUtilityControllerContract' => 'InetStudio\FAQ\Questions\Http\Controllers\Back\QuestionsUtilityController',
        'InetStudio\FAQ\Questions\Contracts\Http\Controllers\Front\QuestionsControllerContract' => 'InetStudio\FAQ\Questions\Http\Controllers\Front\QuestionsController',
        
        // Events
        'InetStudio\FAQ\Questions\Contracts\Events\Back\ModifyQuestionEventContract' => 'InetStudio\FAQ\Questions\Events\Back\ModifyQuestionEvent',
        
        // Mails
        'InetStudio\FAQ\Questions\Contracts\Mail\NewQuestionMailContract' => 'InetStudio\FAQ\Questions\Mail\NewQuestionMail',
        
        // Models
        'InetStudio\FAQ\Questions\Contracts\Models\QuestionModelContract' => 'InetStudio\FAQ\Questions\Models\QuestionModel',
        
        // Notifications
        'InetStudio\FAQ\Questions\Contracts\Notifications\NewQuestionNotificationContract' => 'InetStudio\FAQ\Questions\Notifications\NewQuestionNotification',
        'InetStudio\FAQ\Questions\Contracts\Notifications\NewQuestionQueueableNotificationContract' => 'InetStudio\FAQ\Questions\Notifications\NewQuestionQueueableNotification',
        
        // Observers
        'InetStudio\FAQ\Questions\Contracts\Observers\QuestionObserverContract' => 'InetStudio\FAQ\Questions\Observers\QuestionObserver',
        
        // Repositories
        'InetStudio\FAQ\Questions\Contracts\Repositories\QuestionsRepositoryContract' => 'InetStudio\FAQ\Questions\Repositories\QuestionsRepository',
        
        // Requests
        'InetStudio\FAQ\Questions\Contracts\Http\Requests\Back\SaveQuestionRequestContract' => 'InetStudio\FAQ\Questions\Http\Requests\Back\SaveQuestionRequest',
        'InetStudio\FAQ\Questions\Contracts\Http\Requests\Front\SaveQuestionRequestContract' => 'InetStudio\FAQ\Questions\Http\Requests\Front\SaveQuestionRequest',

        // Responses
        'InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Questions\DestroyResponseContract' => 'InetStudio\FAQ\Questions\Http\Responses\Back\Questions\DestroyResponse',
        'InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Questions\FormResponseContract' => 'InetStudio\FAQ\Questions\Http\Responses\Back\Questions\FormResponse',
        'InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Questions\IndexResponseContract' => 'InetStudio\FAQ\Questions\Http\Responses\Back\Questions\IndexResponse',
        'InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Questions\SaveResponseContract' => 'InetStudio\FAQ\Questions\Http\Responses\Back\Questions\SaveResponse',
        'InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Questions\ShowResponseContract' => 'InetStudio\FAQ\Questions\Http\Responses\Back\Questions\ShowResponse',
        'InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Utility\ActivityResponseContract' => 'InetStudio\FAQ\Questions\Http\Responses\Back\Utility\ActivityResponse',
        'InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract' => 'InetStudio\FAQ\Questions\Http\Responses\Back\Utility\SuggestionsResponse',
        'InetStudio\FAQ\Questions\Contracts\Http\Responses\Front\SaveResponseContract' => 'InetStudio\FAQ\Questions\Http\Responses\Front\SaveResponse',

        // Services
        'InetStudio\FAQ\Questions\Contracts\Services\Back\QuestionsDataTableServiceContract' => 'InetStudio\FAQ\Questions\Services\Back\QuestionsDataTableService',
        'InetStudio\FAQ\Questions\Contracts\Services\Back\QuestionsObserverServiceContract' => 'InetStudio\FAQ\Questions\Services\Back\QuestionsObserverService',
        'InetStudio\FAQ\Questions\Contracts\Services\Back\QuestionsServiceContract' => 'InetStudio\FAQ\Questions\Services\Back\QuestionsService',
        'InetStudio\FAQ\Questions\Contracts\Services\Front\QuestionsServiceContract' => 'InetStudio\FAQ\Questions\Services\Front\QuestionsService',
        
        // Transformers
        'InetStudio\FAQ\Questions\Contracts\Transformers\Back\QuestionTransformerContract' => 'InetStudio\FAQ\Questions\Transformers\Back\QuestionTransformer',
        'InetStudio\FAQ\Questions\Contracts\Transformers\Back\SuggestionTransformerContract' => 'InetStudio\FAQ\Questions\Transformers\Back\SuggestionTransformer',
    ];

    /**
     * Получить сервисы от провайдера.
     *
     * @return array
     */
    public function provides(): array
    {
        return [
            'InetStudio\FAQ\Questions\Contracts\Http\Controllers\Back\QuestionsControllerContract',
            'InetStudio\FAQ\Questions\Contracts\Http\Controllers\Back\QuestionsDataControllerContract',
            'InetStudio\FAQ\Questions\Contracts\Http\Controllers\Back\QuestionsUtilityControllerContract',
            'InetStudio\FAQ\Questions\Contracts\Http\Controllers\Front\QuestionsControllerContract',
            'InetStudio\FAQ\Questions\Contracts\Events\Back\ModifyQuestionEventContract',
            'InetStudio\FAQ\Questions\Contracts\Mail\NewQuestionMailContract',
            'InetStudio\FAQ\Questions\Contracts\Models\QuestionModelContract',
            'InetStudio\FAQ\Questions\Contracts\Notifications\NewQuestionNotificationContract',
            'InetStudio\FAQ\Questions\Contracts\Notifications\NewQuestionQueueableNotificationContract',
            'InetStudio\FAQ\Questions\Contracts\Observers\QuestionObserverContract',
            'InetStudio\FAQ\Questions\Contracts\Repositories\QuestionsRepositoryContract',
            'InetStudio\FAQ\Questions\Contracts\Http\Requests\Back\SaveQuestionRequestContract',
            'InetStudio\FAQ\Questions\Contracts\Http\Requests\Front\SaveQuestionRequestContract',
            'InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Questions\DestroyResponseContract',
            'InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Questions\FormResponseContract',
            'InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Questions\IndexResponseContract',
            'InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Questions\SaveResponseContract',
            'InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Questions\ShowResponseContract',
            'InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract',
            'InetStudio\FAQ\Questions\Contracts\Http\Responses\Front\SaveResponseContract',
            'InetStudio\FAQ\Questions\Contracts\Services\Back\QuestionsDataTableServiceContract',
            'InetStudio\FAQ\Questions\Contracts\Services\Back\QuestionsObserverServiceContract',
            'InetStudio\FAQ\Questions\Contracts\Services\Back\QuestionsServiceContract',
            'InetStudio\FAQ\Questions\Contracts\Services\Front\QuestionsServiceContract',
            'InetStudio\FAQ\Questions\Contracts\Transformers\Back\QuestionTransformerContract',
            'InetStudio\FAQ\Questions\Contracts\Transformers\Back\SuggestionTransformerContract',
        ];
    }
}
