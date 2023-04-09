<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::match(['get', 'post'], 'register', [\App\Http\Controllers\AuthenticationController::class, 'register'])->name('register');
Route::match(['get', 'post'], 'login', [\App\Http\Controllers\AuthenticationController::class, 'login'])->name('login');

Route::group(['prefix' => 'form/{formSurvey:public_form_id}'], function () {
    Route::get('', [\App\Http\Controllers\FormController::class, 'index'])->name('form.index');
    Route::get('edit', [\App\Http\Controllers\FormController::class, 'edit'])->name('form.edit')->middleware('auth');
    Route::get('responses', [\App\Http\Controllers\FormController::class, 'responses'])->name('form.responses')->middleware('auth');
    Route::post('submit', [\App\Http\Controllers\FormController::class, 'submitForm'])->name('form.submit-form');
});

Route::get('logout', [\App\Http\Controllers\AuthenticationController::class, 'logout'])->name('logout')->middleware('auth');