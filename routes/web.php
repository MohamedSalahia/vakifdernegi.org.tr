<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;


Route::middleware([''])
    ->group(function () {

        Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

        Route::get('/home', [HomeController::class, 'index'])->name('home');

        require __DIR__ . '/auth.php';

    });



