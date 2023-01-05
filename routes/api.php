<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HojaVidaController;
use App\Http\Controllers\UserDocumentsController;
use App\Http\Controllers\UserWorkExperienceController;
use App\Http\Controllers\UserTrainingExperienceController;

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

Route::get('/profile/info/{id}', [UserController::class, 'showProfileInfo'])
    ->middleware('auth:api')
    ->name('profile.showProfileInfo');

Route::post('/profile/update', [UserController::class, 'update'])
    ->middleware('auth:api')
    ->name('profile.update');

//Work Experience Seccion
Route::get('/experience/get', [UserWorkExperienceController::class, 'get'])
    ->middleware('auth:api')
    ->name('experience.get');

Route::get('/experience/get/{id}', [UserWorkExperienceController::class, 'getByUser'])
    ->middleware('auth:api')
    ->name('experience.getByUser');

Route::get('/experience/get/{user_id}/{experience_id}', [UserWorkExperienceController::class, 'getSpecific'])
    ->middleware('auth:api')
    ->name('experience.getSpecific');

//Seccion Training
Route::get('/training/get', [UserTrainingExperienceController::class, 'get'])
    ->middleware('auth:api')
    ->name('training.get');

Route::get('/training/get/{id}', [UserTrainingExperienceController::class, 'getByUser'])
    ->middleware('auth:api')
    ->name('training.getByUser');

Route::get('/training/get/{user_id}/{experience_id}', [UserTrainingExperienceController::class, 'getSpecific'])
    ->middleware('auth:api')
    ->name('training.getSpecific');

//Seccion Documentos
Route::get('/documents/get', [UserDocumentsController::class, 'get'])
    ->middleware('auth:api')
    ->name('documents.get');

Route::get('/documents/get/{id}', [UserDocumentsController::class, 'getByUser'])
    ->middleware('auth:api')
    ->name('documents.getByUser');

Route::get('/documents/get/{user_id}/{document_id}', [UserDocumentsController::class, 'getSpecific'])
    ->middleware('auth:api')
    ->name('documents.getSpecific');


//Seccion hojas de vida
Route::get('/cv/get', [HojaVidaController::class, 'get'])
    ->middleware('auth:api')
    ->name('hojas.get');

Route::get('/cv/get/{id}', [HojaVidaController::class, 'getSpecific'])
    ->middleware('auth:api')
    ->name('hojas.getByUser');


require __DIR__ . '/auth.php';
