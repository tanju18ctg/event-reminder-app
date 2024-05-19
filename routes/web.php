<?php

use App\Http\Controllers\EventController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::resource('/', EventController::class);

Route::get('/', [EventController::class,'index'])->name('index');
Route::get('add-event', [EventController::class,'createEvent'])->name('add-event');
Route::post('eventStore', [EventController::class,'eventStore'])->name('event-store');
Route::get('eventEdit/{id}', [EventController::class,'eventEdit'])->name('event-edit');
Route::get('eventDelete/{id}', [EventController::class,'eventDelete']);
Route::post('eventUpdate/{id}', [EventController::class,'eventUpdate'])->name('event-update');
Route::post('import-csv', [EventController::class, 'importCSV'])->name('import');



