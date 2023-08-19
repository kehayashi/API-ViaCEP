<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('index');
});

Route::post('/api', [\App\Http\Controllers\ApiController::Class, 'searchCep']);