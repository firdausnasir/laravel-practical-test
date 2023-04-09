<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register', [\App\Http\Controllers\AuthenticationController::class, 'register']);
Route::post('login', [\App\Http\Controllers\AuthenticationController::class, 'login']);



Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('form/input/all', [\App\Http\Controllers\FormController::class, 'getFormInputs'])->name('api.form.input.all');
    Route::put('form/{formSurvey:public_form_id}/update', [\App\Http\Controllers\FormController::class, 'update'])->name('api.form.update');

    Route::post('logout', [\App\Http\Controllers\AuthenticationController::class, 'logout']);
    Route::get('user', function (Request $request) {
        return $request->user();
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
