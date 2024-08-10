<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\PublisherController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::post('/events', [EventController::class , 'store']);
Route::patch('/events/{event}', [EventController::class , 'update']);
Route::post('/publisher', [PublisherController::class, 'store']);
Route::patch('/publisher/{publisher}', [PublisherController::class, 'update']);