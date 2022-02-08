<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


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

Route::post('/login', function () {
    return 'test';
});

Route::get('/docker', function () {
    return 'Docker alive';
});

Route::get('/prepare-to-login', function () {
    $state = Str::random(40);

    session([
        'state' => $state
    ]);

    $query = http_build_query([
        'client_id' => 3,
        'redirect_url' => 'http://localhost:8001/callback',
        'response_type' => 'code',
        'scope' => '',
        'state' => $state,
    ]);

    return redirect('http://localhost:8000/oauth/authorize?'.$query);
})->name('prepare-to-login');

Route::get('/callback', function (Request $request) {
    // dd($_REQUEST);
    dd($request->all());

    // verificação de state, double check
    $response = Http::post('http://localhost:8000/oauth/token', [
        'grant_type' => 'authorization_code',
        'client_id' => 3,
        'client_secret' => 'AMmbkMcE2TeCg3PN7vDQXDMjM2RXoLXBPvVj8PMv',
        'redirect_url' => 'http://localhost:8001/callback',
        'code' => $request->code
    ]);

    dd($response->json());
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
