<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'namespace' => 'InetStudio\FAQ\Questions\Contracts\Http\Controllers\Back',
        'middleware' => ['web', 'back.auth'],
        'prefix' => 'back/faq',
    ],
    function () {
        Route::any('questions/data', 'DataControllerContract@data')
            ->name('back.faq.questions.data.index');

        Route::post('questions/suggestions', 'UtilityControllerContract@getSuggestions')
            ->name('back.faq.questions.getSuggestions');

        Route::get('questions/export', 'ExportControllerContract@exportItems')
            ->name('back.faq.questions.export');

        Route::post('questions/moderate/activity', 'ModerateControllerContract@activity')
            ->name('back.faq.questions.moderate.activity');

        Route::post('questions/moderate/read', 'ModerateControllerContract@read')
            ->name('back.faq.questions.moderate.read');

        Route::post('questions/moderate/destroy', 'ModerateControllerContract@destroy')
            ->name('back.faq.questions.moderate.destroy');

        Route::resource('questions', 'ResourceControllerContract', ['as' => 'back.faq']);
    }
);

Route::group(
    [
        'namespace' => 'InetStudio\FAQ\Questions\Contracts\Http\Controllers\Front',
        'middleware' => ['web'],
    ],
    function () {
        Route::any('faq/questions/send', 'ItemsControllerContract@save')->name('front.faq.questions.send');
    }
);
