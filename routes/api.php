<?php

use App\Events\PrivateChat;
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

// Route::get('/send-message', function (Request $request) {
//     $user = $request->user;
//     $message = $request->message;
//     broadcast(new PrivateChat($user, $message));
//     return ['test'];
// });

Route::get('/private-event', function () {
    $user = "sami";
    $message = "test message";
    broadcast(new PrivateChat($user, $message));
    return 'done';
});

Route::post("/pusher/user-auth", function (Request $request) {
});
