<?php

use Illuminate\Http\Request;

Route::group(['prefix' => 'v1'], function () {

    Route::get('/pessoas', 'Api\PessoaController@index');

    Route::post('/pessoa', 'Api\PessoaController@store');
    
    Route::get('/pessoa/{id}', 'Api\PessoaController@show')->where('id', '[1-9]+');

    Route::put('/pessoa/{id}', 'Api\PessoaController@update')->where('id', '[1-9]+');

    Route::delete('/pessoa/{id}', 'Api\PessoaController@destroy');
        
});
