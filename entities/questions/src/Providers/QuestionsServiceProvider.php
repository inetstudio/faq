<?php

namespace InetStudio\FAQ\Questions\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class QuestionsServiceProvider.
 */
class QuestionsServiceProvider extends ServiceProvider
{
    /**
     * Загрузка сервиса.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerConsoleCommands();
        $this->registerPublishes();
        $this->registerRoutes();
        $this->registerViews();
        $this->registerTranslations();
        $this->registerObservers();
    }

    /**
     * Регистрация привязки в контейнере.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerBindings();
    }

    /**
     * Регистрация команд.
     *
     * @return void
     */
    protected function registerConsoleCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                'InetStudio\FAQ\Questions\Console\Commands\SetupCommand',
                'InetStudio\FAQ\Questions\Console\Commands\CreateFoldersCommand',
            ]);
        }
    }

    /**
     * Регистрация ресурсов.
     *
     * @return void
     */
    protected function registerPublishes(): void
    {
        $this->publishes([
            __DIR__.'/../../config/faq_questions.php' => config_path('faq_questions.php'),
        ], 'config');

        $this->mergeConfigFrom(
            __DIR__.'/../../config/filesystems.php', 'filesystems.disks'
        );

        if ($this->app->runningInConsole()) {
            if (! class_exists('CreateFAQQuestionsTables')) {
                $timestamp = date('Y_m_d_His', time());
                $this->publishes([
                    __DIR__.'/../../database/migrations/create_faq_questions_tables.php.stub' => database_path('migrations/'.$timestamp.'_create_faq_questions_tables.php'),
                ], 'migrations');
            }
        }
    }

    /**
     * Регистрация путей.
     *
     * @return void
     */
    protected function registerRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
    }

    /**
     * Регистрация представлений.
     *
     * @return void
     */
    protected function registerViews(): void
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'admin.module.faq.questions');
    }

    /**
     * Регистрация переводов.
     *
     * @return void
     */
    protected function registerTranslations(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'admin.module.faq.questions');
    }

    /**
     * Регистрация наблюдателей.
     *
     * @return void
     */
    public function registerObservers(): void
    {
        $this->app->make('InetStudio\FAQ\Questions\Contracts\Models\QuestionModelContract')::observe($this->app->make('InetStudio\FAQ\Questions\Contracts\Observers\QuestionObserverContract'));
    }

    /**
     * Регистрация привязок, алиасов и сторонних провайдеров сервисов.
     *
     * @return void
     */
    protected function registerBindings(): void
    {
        // Controllers
        $this->app->bind('InetStudio\FAQ\Questions\Contracts\Http\Controllers\Back\QuestionsControllerContract', 'InetStudio\FAQ\Questions\Http\Controllers\Back\QuestionsController');
        $this->app->bind('InetStudio\FAQ\Questions\Contracts\Http\Controllers\Back\QuestionsDataControllerContract', 'InetStudio\FAQ\Questions\Http\Controllers\Back\QuestionsDataController');
        $this->app->bind('InetStudio\FAQ\Questions\Contracts\Http\Controllers\Back\QuestionsUtilityControllerContract', 'InetStudio\FAQ\Questions\Http\Controllers\Back\QuestionsUtilityController');
        $this->app->bind('InetStudio\FAQ\Questions\Contracts\Http\Controllers\Front\QuestionsControllerContract', 'InetStudio\FAQ\Questions\Http\Controllers\Front\QuestionsController');

        // Events
        $this->app->bind('InetStudio\FAQ\Questions\Contracts\Events\Back\ModifyQuestionEventContract', 'InetStudio\FAQ\Questions\Events\Back\ModifyQuestionEvent');
        $this->app->bind('InetStudio\FAQ\Questions\Contracts\Events\Front\SendQuestionEventContract', 'InetStudio\FAQ\Questions\Events\Front\SendQuestionEvent');

        // Mails
        $this->app->bind('InetStudio\FAQ\Questions\Contracts\Mail\AnswerMailContract', 'InetStudio\FAQ\Questions\Mail\AnswerMail');
        $this->app->bind('InetStudio\FAQ\Questions\Contracts\Mail\NewQuestionMailContract', 'InetStudio\FAQ\Questions\Mail\NewQuestionMail');

        // Models
        $this->app->bind('InetStudio\FAQ\Questions\Contracts\Models\QuestionModelContract', 'InetStudio\FAQ\Questions\Models\QuestionModel');

        // Notifications
        $this->app->bind('InetStudio\FAQ\Questions\Contracts\Notifications\AnswerNotificationContract', 'InetStudio\FAQ\Questions\Notifications\AnswerNotification');
        $this->app->bind('InetStudio\FAQ\Questions\Contracts\Notifications\NewQuestionNotificationContract', 'InetStudio\FAQ\Questions\Notifications\NewQuestionNotification');
        $this->app->bind('InetStudio\FAQ\Questions\Contracts\Notifications\AnswerQueueableNotificationContract', 'InetStudio\FAQ\Questions\Notifications\AnswerQueueableNotification');
        $this->app->bind('InetStudio\FAQ\Questions\Contracts\Notifications\NewQuestionQueueableNotificationContract', 'InetStudio\FAQ\Questions\Notifications\NewQuestionQueueableNotification');

        // Observers
        $this->app->bind('InetStudio\FAQ\Questions\Contracts\Observers\QuestionObserverContract', 'InetStudio\FAQ\Questions\Observers\QuestionObserver');

        // Repositories
        $this->app->bind('InetStudio\FAQ\Questions\Contracts\Repositories\QuestionsRepositoryContract', 'InetStudio\FAQ\Questions\Repositories\QuestionsRepository');

        // Requests
        $this->app->bind('InetStudio\FAQ\Questions\Contracts\Http\Requests\Back\SaveQuestionRequestContract', 'InetStudio\FAQ\Questions\Http\Requests\Back\SaveQuestionRequest');
        $this->app->bind('InetStudio\FAQ\Questions\Contracts\Http\Requests\Front\SaveQuestionRequestContract', 'InetStudio\FAQ\Questions\Http\Requests\Front\SaveQuestionRequest');

        // Responses
        $this->app->bind('InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Questions\DestroyResponseContract', 'InetStudio\FAQ\Questions\Http\Responses\Back\Questions\DestroyResponse');
        $this->app->bind('InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Questions\FormResponseContract', 'InetStudio\FAQ\Questions\Http\Responses\Back\Questions\FormResponse');
        $this->app->bind('InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Questions\IndexResponseContract', 'InetStudio\FAQ\Questions\Http\Responses\Back\Questions\IndexResponse');
        $this->app->bind('InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Questions\SaveResponseContract', 'InetStudio\FAQ\Questions\Http\Responses\Back\Questions\SaveResponse');
        $this->app->bind('InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Questions\ShowResponseContract', 'InetStudio\FAQ\Questions\Http\Responses\Back\Questions\ShowResponse');
        $this->app->bind('InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Utility\ActivityResponseContract', 'InetStudio\FAQ\Questions\Http\Responses\Back\Utility\ActivityResponse');
        $this->app->bind('InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract', 'InetStudio\FAQ\Questions\Http\Responses\Back\Utility\SuggestionsResponse');
        $this->app->bind('InetStudio\FAQ\Questions\Contracts\Http\Responses\Front\SaveResponseContract', 'InetStudio\FAQ\Questions\Http\Responses\Front\SaveResponse');

        // Services
        $this->app->bind('InetStudio\FAQ\Questions\Contracts\Services\Back\QuestionsDataTableServiceContract', 'InetStudio\FAQ\Questions\Services\Back\QuestionsDataTableService');
        $this->app->bind('InetStudio\FAQ\Questions\Contracts\Services\Back\QuestionsObserverServiceContract', 'InetStudio\FAQ\Questions\Services\Back\QuestionsObserverService');
        $this->app->bind('InetStudio\FAQ\Questions\Contracts\Services\Back\QuestionsServiceContract', 'InetStudio\FAQ\Questions\Services\Back\QuestionsService');
        $this->app->bind('InetStudio\FAQ\Questions\Contracts\Services\Front\QuestionsServiceContract', 'InetStudio\FAQ\Questions\Services\Front\QuestionsService');

        // Transformers
        $this->app->bind('InetStudio\FAQ\Questions\Contracts\Transformers\Back\QuestionTransformerContract', 'InetStudio\FAQ\Questions\Transformers\Back\QuestionTransformer');
        $this->app->bind('InetStudio\FAQ\Questions\Contracts\Transformers\Back\SuggestionTransformerContract', 'InetStudio\FAQ\Questions\Transformers\Back\SuggestionTransformer');
    }
}
