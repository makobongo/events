<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\TicketController;
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

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::post('/events', [EventController::class , 'store']);
Route::patch('/events/{event}', [EventController::class , 'update']);
Route::delete('/events/{event}', [EventController::class , 'destroy']);
Route::post('/publisher', [PublisherController::class, 'store']);
Route::patch('/publisher/{publisher}', [PublisherController::class, 'update']);
Route::post('/ticket', [TicketController::class, 'store'])->name('ticket.store');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
