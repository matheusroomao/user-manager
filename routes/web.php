<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('user.index');
});


Route::resource('usuarios', \App\Http\Controllers\Web\UserController::class)->names('user');
