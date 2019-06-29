<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'namespace' => 'InetStudio\FAQ\Tags\Contracts\Http\Controllers\Back',
        'middleware' => ['web', 'back.auth'],
        'prefix' => 'back/faq',
    ],
    function () {
        Route::any('tags/data', 'DataControllerContract@data')
            ->name('back.faq.tags.data.index');

        Route::post('tags/suggestions', 'UtilityControllerContract@getSuggestions')
            ->name('back.faq.tags.getSuggestions');

        Route::resource('tags', 'ResourceControllerContract', ['as' => 'back.faq']);
    }
);
