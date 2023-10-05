<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/template/preview', function () {
    return Storage::get("file/preview.html");
});
Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
