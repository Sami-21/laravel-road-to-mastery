<?php

use App\Events\Chat;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::post('/send', function (Request $request) {
    $user = $request->user;
    $message = $request->message;
    broadcast(new Chat($user, $message));
    return ['test'];
});

// Route::get('/private-event', function () {
//     $user = "sami";
//     $message = "test message";
//     broadcast(new PrivateChat($user, $message));
//     return 'done';
// });
