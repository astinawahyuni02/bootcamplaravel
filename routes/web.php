<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|`
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('guestbooks')->group(function () {

    Route::get('/', [App\Http\Controllers\GuestBooksController::class, 'index']);
    Route::get('/getData', [App\Http\Controllers\GuestBooksController::class, 'getData']);
    Route::post('/createData', [App\Http\Controllers\GuestBooksController::class, 'createData']);
    Route::post('/updateData/{id}', [App\Http\Controllers\GuestBooksController::class, 'updateData']);
    Route::post('/deleteData/{id}', [App\Http\Controllers\GuestBooksController::class, 'deleteData']);

});
