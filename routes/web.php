<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreatioBonusController;

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
//    return view('welcome');
    return abort('404');
});

Route::prefix('creatio')->group(function () {
    Route::get('bonuses', [CreatioBonusController::class, 'index']);
});
