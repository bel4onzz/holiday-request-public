<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/holiday', [App\Http\Controllers\HolidayRequestController::class, 'index'])->name('holidays')->middleware('auth');
Route::post('/holiday', [App\Http\Controllers\HolidayRequestController::class, 'store'])->name('store_holiday_request')->middleware('auth');
Route::get('/holiday/create', [App\Http\Controllers\HolidayRequestController::class, 'create'])->name('create_holiday_reqest')->middleware('auth');
Route::get('/holiday/{holiday_id}', [App\Http\Controllers\HolidayRequestController::class, 'show'])->name('show_holiday')->middleware('auth');
Route::put('/holiday/{holiday_id}', [App\Http\Controllers\HolidayRequestController::class, 'update'])->name('update_holiday_request')->middleware('auth');
Route::get('/holiday/{holiday_id}/edit', [App\Http\Controllers\HolidayRequestController::class, 'edit'])->name('edit_holiday_request')->middleware('auth');