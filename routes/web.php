<?php

use App\Http\Controllers\BonusController;
use App\Http\Controllers\CmsController;
use App\Http\Controllers\MoneyController;
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
Route::POST('/raffle/convert/{id}', [RafflePrizeController::class,'convert'])
    ->where('id', '[0-9]+');
Route::POST('/raffle/refuse/{id}', [RafflePrizeController::class,'refuse'])
    ->where('id', '[0-9]+');

Route::POST('/money/send', [MoneyController::class, 'send']);

Route::POST('/bonus/send/{id}', [BonusController::class, 'send']);

Route::POST('/cms/item/send/{id}', [CmsController::class, 'sendItem']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
