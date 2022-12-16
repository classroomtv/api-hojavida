<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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



//Profile Seccion
Route::get('/profile/info', [UserController::class, 'info'])
    ->middleware('auth:api')
    ->name('profile.info');

Route::post('/profile/update', [UserController::class, 'update'])
    ->middleware('auth:api')
    ->name('profile.update');


require __DIR__ . '/auth.php';
