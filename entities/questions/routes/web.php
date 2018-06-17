<?php

Route::group([
    'namespace' => 'InetStudio\FAQ\Questions\Contracts\Http\Controllers\Back',
    'middleware' => ['web', 'back.auth'],
    'prefix' => 'back/faq',
], function () {
    Route::any('questions/data', 'QuestionsDataControllerContract@data')->name('back.faq.questions.data.index');
    Route::post('questions/activity/{id}', 'QuestionsUtilityControllerContract@changeActivity')->name('back.faq.questions.activity');
    Route::post('questions/suggestions', 'QuestionsUtilityControllerContract@getSuggestions')->name('back.faq.questions.getSuggestions');

    Route::resource('questions', 'QuestionsControllerContract', ['as' => 'back.faq']);
});

Route::group([
    'namespace' => 'InetStudio\FAQ\Questions\Contracts\Http\Controllers\Front',
    'middleware' => ['web'],
], function () {
    Route::any('faq/questions/send', 'QuestionsControllerContract@save')->name('front.faq.questions.send');
});
