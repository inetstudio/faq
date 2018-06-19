<?php

namespace InetStudio\FAQ\Tags\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class TagsServiceProvider.
 */
class TagsServiceProvider extends ServiceProvider
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
                'InetStudio\FAQ\Tags\Console\Commands\SetupCommand',
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
        if ($this->app->runningInConsole()) {
            if (! class_exists('CreateFAQTagsTables')) {
                $timestamp = date('Y_m_d_His', time());
                $this->publishes([
                    __DIR__.'/../../database/migrations/create_faq_tags_tables.php.stub' => database_path('migrations/'.$timestamp.'_create_faq_tags_tables.php'),
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
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'admin.module.faq.tags');
    }

    /**
     * Регистрация привязок, алиасов и сторонних провайдеров сервисов.
     *
     * @return void
     */
    protected function registerBindings(): void
    {
        // Controllers
        $this->app->bind('InetStudio\FAQ\Tags\Contracts\Http\Controllers\Back\TagsControllerContract', 'InetStudio\FAQ\Tags\Http\Controllers\Back\TagsController');
        $this->app->bind('InetStudio\FAQ\Tags\Contracts\Http\Controllers\Back\TagsDataControllerContract', 'InetStudio\FAQ\Tags\Http\Controllers\Back\TagsDataController');
        $this->app->bind('InetStudio\FAQ\Tags\Contracts\Http\Controllers\Back\TagsUtilityControllerContract', 'InetStudio\FAQ\Tags\Http\Controllers\Back\TagsUtilityController');

        // Events
        $this->app->bind('InetStudio\FAQ\Tags\Contracts\Events\Back\ModifyTagEventContract', 'InetStudio\FAQ\Tags\Events\Back\ModifyTagEvent');

        // Models
        $this->app->bind('InetStudio\FAQ\Tags\Contracts\Models\TagModelContract', 'InetStudio\FAQ\Tags\Models\TagModel');
        $this->app->bind('InetStudio\FAQ\Tags\Contracts\Models\TaggableModelContract', 'InetStudio\FAQ\Tags\Models\TaggableModel');

        // Observers
        $this->app->bind('InetStudio\FAQ\Tags\Contracts\Observers\TagObserverContract', 'InetStudio\FAQ\Tags\Observers\TagObserver');

        // Repositories
        $this->app->bind('InetStudio\FAQ\Tags\Contracts\Repositories\TagsRepositoryContract', 'InetStudio\FAQ\Tags\Repositories\TagsRepository');
        $this->app->bind('InetStudio\FAQ\Tags\Contracts\Repositories\TaggablesRepositoryContract', 'InetStudio\FAQ\Tags\Repositories\TaggablesRepository');

        // Requests
        $this->app->bind('InetStudio\FAQ\Tags\Contracts\Http\Requests\Back\SaveTagRequestContract', 'InetStudio\FAQ\Tags\Http\Requests\Back\SaveTagRequest');

        // Responses
        $this->app->bind('InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Tags\DestroyResponseContract', 'InetStudio\FAQ\Tags\Http\Responses\Back\Tags\DestroyResponse');
        $this->app->bind('InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Tags\FormResponseContract', 'InetStudio\FAQ\Tags\Http\Responses\Back\Tags\FormResponse');
        $this->app->bind('InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Tags\IndexResponseContract', 'InetStudio\FAQ\Tags\Http\Responses\Back\Tags\IndexResponse');
        $this->app->bind('InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Tags\SaveResponseContract', 'InetStudio\FAQ\Tags\Http\Responses\Back\Tags\SaveResponse');
        $this->app->bind('InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Tags\ShowResponseContract', 'InetStudio\FAQ\Tags\Http\Responses\Back\Tags\ShowResponse');
        $this->app->bind('InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract', 'InetStudio\FAQ\Tags\Http\Responses\Back\Utility\SuggestionsResponse');

        // Services
        $this->app->bind('InetStudio\FAQ\Tags\Contracts\Services\Back\TagsDataTableServiceContract', 'InetStudio\FAQ\Tags\Services\Back\TagsDataTableService');
        $this->app->bind('InetStudio\FAQ\Tags\Contracts\Services\Back\TagsObserverServiceContract', 'InetStudio\FAQ\Tags\Services\Back\TagsObserverService');
        $this->app->bind('InetStudio\FAQ\Tags\Contracts\Services\Back\TagsServiceContract', 'InetStudio\FAQ\Tags\Services\Back\TagsService');
        $this->app->bind('InetStudio\FAQ\Tags\Contracts\Services\Front\TagsServiceContract', 'InetStudio\FAQ\Tags\Services\Front\TagsService');

        // Transformers
        $this->app->bind('InetStudio\FAQ\Tags\Contracts\Transformers\Back\TagTransformerContract', 'InetStudio\FAQ\Tags\Transformers\Back\TagTransformer');
        $this->app->bind('InetStudio\FAQ\Tags\Contracts\Transformers\Back\SuggestionTransformerContract', 'InetStudio\FAQ\Tags\Transformers\Back\SuggestionTransformer');
    }
}
