<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentsController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/new_ticket', [TicketsController::class, 'create']);
Route::post('/new_ticket', [TicketsController::class, 'store']);
Route::get('my_tickets', [TicketsController::class, 'userTickets']);
Route::get('tickets/{ticket_id}', [TicketsController::class, 'show']);
Route::post('comment', [CommentsController::class, 'postComment']);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
    Route::get('tickets', [TicketsController::class,'index']);
    Route::post('close_ticket/{ticket_id}', [TicketsController::class,'close']);
});
