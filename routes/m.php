<?php

use App\Http\Controllers\M\MHomeController;
use Illuminate\Support\Facades\Route;

Route::domain('https://m.worldcarrental.com')->prefix('{locale}')->where(['locale' => '[a-zA-Z]{2}'])->middleware( ['setlocale','removepublic'])->group(function () {

    Route::get('/', [MHomeController::class, 'index']);
});
