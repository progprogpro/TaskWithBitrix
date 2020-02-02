<?php


Route::get('/', 'MainController@index')->name('index');

Route::resource('leads','LeadsController')->only(['index','store','destroy']);

Route::group([ 'prefix'=>'autoria', 'as' => 'autoria.', 'namespace' => 'Autoria' ], function(){
    Route::get('categories', 'AutoriaController@categories')->name('categories');
    Route::get('marks', 'AutoriaController@marks')->name('marks');
    Route::get('models', 'AutoriaController@models')->name('models');
});

Route::group([ 'prefix'=>'bitrix', 'as' => 'bitrix.', 'namespace' => 'Bitrix' ], function() {
    Route::get('oauth', 'AuthBitrixController@auth')->name('auth');
    Route::get('addLead', 'RequestBitrixController@addLead')->name('addLead');
});
