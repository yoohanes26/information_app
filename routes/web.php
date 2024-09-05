<?php

use Illuminate\Support\Facades\Route;

$router->group(['namespace' => '\App\Http\Controllers'], function() use ($router){
    Route::get('/', 'InformationController@homepage');
    Route::get('/information', 'InformationController@getInformation');
    Route::post('/information', 'InformationController@createInformation');
    Route::put('/information', 'InformationController@editInformation');
    Route::delete('/information', 'InformationController@deleteInformation');
});
