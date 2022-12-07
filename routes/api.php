<?php

use Illuminate\Http\Request;

Route::group(['prefix' => 'v1'], function () {
    
    Route::post('/pessoa', 'Api\PessoaController@store');
    Route::get('/pessoa/{id}', 'Api\PessoaController@show')->where('id', '[1-9]+');

    Route::put('/pessoa', 'Api\PessoaController@update');

    Route::delete('pessoa', 'Api\PessoaController@destroy');
        
});
