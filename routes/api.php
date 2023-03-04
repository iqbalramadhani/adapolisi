<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\SampleDataController;
use App\Http\Controllers\LaravoltDataController;
use App\Http\Controllers\ListDataController;
use App\Http\Controllers\Offenders\OffenderController;
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

// Route::middleware('auth:web')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Sample API route
Route::get('/profits', [SampleDataController::class, 'profits'])->name('profits');

Route::post('/register', [RegisteredUserController::class, 'apiStore']);

Route::post('/login', [AuthenticatedSessionController::class, 'apiStore']);

Route::post('/forgot_password', [PasswordResetLinkController::class, 'apiStore']);

Route::post('/verify_token', [AuthenticatedSessionController::class, 'apiVerifyToken']);

Route::get('/users', [SampleDataController::class, 'getUsers']);


Route::prefix('laravolt')->group(function () {
    Route::get('provinces', [LaravoltDataController::class, 'getProvinces'])->name('laravolt.provinces');
    Route::get('cities', [LaravoltDataController::class, 'getCities'])->name('laravolt.cities');
    Route::get('districts', [LaravoltDataController::class, 'getDistricts'])->name('laravolt.districts');
    Route::get('subdistricts', [LaravoltDataController::class, 'getSubdistricts'])->name('laravolt.subdistricts');
});

Route::middleware('auth:api')->group(function () {

    Route::prefix('list')->group(function () {
        Route::get('jobs', [ListDataController::class, 'getJobs'])->name('list.jobs');
    });

    Route::prefix('offender')->group(function () {
        Route::post('create', [OffenderController::class, 'createOffender'])->name('offender.create');
        Route::post('create-general-info', [OffenderController::class, 'createGeneralInfo'])->name('offender.generalInfo');
        Route::post('create-personal-info', [OffenderController::class, 'createPersonalInfo'])->name('offender.personalInfo');
    });

});