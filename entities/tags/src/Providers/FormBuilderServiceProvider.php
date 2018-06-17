<?php

namespace InetStudio\FAQ\Tags\Providers;

use Collective\Html\FormBuilder;
use Illuminate\Support\ServiceProvider;

class FormBuilderServiceProvider extends ServiceProvider
{
    /**
     * Загрузка сервиса.
     *
     * @return void
     */
    public function boot(): void
    {
        FormBuilder::component('faq_tags', 'admin.module.faq.tags::back.forms.fields.tags', ['name' => null, 'value' => null, 'attributes' => null]);
    }
}
