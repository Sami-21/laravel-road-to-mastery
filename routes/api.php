<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    return Auth::user();
});

Route::get('/', function (Request $request) {
    return Auth::user();
});


//Chat routes
Route::get('/chat-rooms', [
    ChatController::class,
    'getRooms'
]);
Route::get('/chat-room/{roomId}/messages', [ChatController::class, 'getMessages']);
Route::get('/chat-room/{roomId}', [ChatController::class, 'getRoom']);
Route::post('/chat-room/{roomId}', [ChatController::class, 'newMessage']);

Route::controller(AuthController::class)->group(function () {
    Route::post('login', ['as' => 'login', 'uses' =>  'login']);
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});
