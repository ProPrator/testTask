<?php

use App\Http\Controllers\RafflePrizeController;
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

Route::get('/', [RafflePrizeController::class,'index']);
Route::get('/raffle/congratulation', [RafflePrizeController::class,'raffle']);
Route::get('/raffle/convert', [RafflePrizeController::class,'convert']);
Route::get('/raffle/refuse', [RafflePrizeController::class,'refuse']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
