<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', "UserController@login");

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('product')
        // ->middleware('role:superadmin')
        ->controller(ProductController::class)
        ->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::delete('/{id}', 'delete');
        });

    Route::prefix('invoice')
        // ->middleware('role:superadmin')
        ->controller(InvoiceController::class)
        ->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/{id}', 'get');
        });

    Route::prefix('user')
        // ->middleware('role:superadmin')
        ->controller(UserController::class)
        ->group(function () {
            Route::get('/', 'profil');
            // Route::post('/', 'store');
        });
    Route::prefix('auth')->controller(UserController::class)->group(function () {
        Route::get('/profile', 'profile');
        Route::get('/logout', 'logout');
    });
    Route::prefix('user')->controller(UserController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::delete('/{id}', 'delete');
    });
});
