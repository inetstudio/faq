<?php

Route::group([
    'namespace' => 'InetStudio\FAQ\Tags\Contracts\Http\Controllers\Back',
    'middleware' => ['web', 'back.auth'],
    'prefix' => 'back/faq',
], function () {
    Route::any('tags/data', 'TagsDataControllerContract@data')->name('back.faq.tags.data.index');
    Route::post('tags/suggestions', 'TagsUtilityControllerContract@getSuggestions')->name('back.faq.tags.getSuggestions');

    Route::resource('tags', 'TagsControllerContract', ['as' => 'back.faq']);
});
