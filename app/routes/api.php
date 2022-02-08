<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('client')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::middleware('client')->get('/account', function (Request $request) {
//     return AccountController::index();
// });

// Route::middleware('client')->post('/account', function (Request $request) {
//     return AccountController::store($request);
// });

# Route::get('/account', [AccountController::class, 'index']);
# Route::get('/account', 'App\Http\Controllers\AccountController');

Route::apiResource('account', 'App\Http\Controllers\AccountController');
Route::apiResource('user', 'App\Http\Controllers\UserController');
Route::apiResource('home', 'App\Http\Controllers\HomeController');

