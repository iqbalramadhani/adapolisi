<?php

use App\Http\Controllers\Account\SettingsController;
use App\Http\Controllers\Auth\SocialiteLoginController;
use App\Http\Controllers\Documentation\LayoutBuilderController;
use App\Http\Controllers\Documentation\ReferencesController;
use App\Http\Controllers\Logs\AuditLogsController;
use App\Http\Controllers\Logs\SystemLogsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\LaravoltDataController;
use App\Http\Controllers\PerpetratorsController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Account\UserController;
use App\Http\Controllers\Account\OffenderController;
use App\Http\Controllers\Account\PerpetratorController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\ListDataKasusController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;

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

// Route::get('/', function () {
//     return redirect('index');
// });

$menu = theme()->getMenu();
array_walk($menu, function ($val) {
    if (isset($val['path'])) {
        $route = Route::get($val['path'], [PagesController::class, 'index']);

        // Exclude documentation from auth middleware
        if (!Str::contains($val['path'], 'documentation')) {
            $route->middleware('auth');
        }

        // Custom page demo for 500 server error
        if (Str::contains($val['path'], 'error-500')) {
            Route::get($val['path'], function () {
                abort(500, 'Something went wrong! Please try again later.');
            });
        }
    }
});

// Documentations pages
Route::prefix('documentation')->group(function () {
    Route::get('getting-started/references', [ReferencesController::class, 'index']);
    Route::get('getting-started/changelog', [PagesController::class, 'index']);
    Route::resource('layout-builder', LayoutBuilderController::class)->only(['store']);
});

Route::prefix('statistic')->group(function () {
    Route::get('individu-job', [StatisticController::class, 'filterIndividuJob'])->name('statistic.filterIndividuJob');
    Route::get('parent-job', [StatisticController::class, 'filterParentJob'])->name('statistic.filterParentJob');
    Route::get('time-pattern', [StatisticController::class, 'filterTimePattern'])->name('statistic.filterTimePattern');
    Route::get('motive-crime', [StatisticController::class, 'filterMotiveCrime'])->name('statistic.filterMotiveCrime');
    Route::get('equipment', [StatisticController::class, 'filterEquipment'])->name('statistic.filterEquipment');
    Route::get('vehicle', [StatisticController::class, 'filterVehicle'])->name('statistic.filterVehicle');
    Route::get('alchohol-indication', [StatisticController::class, 'filterAlchoholIndicate'])->name('statistic.filterAlchoholIndicate');
    Route::get('drug-indication', [StatisticController::class, 'filterDrugIndicate'])->name('statistic.filterDrugIndicate');
    Route::get('gang-member', [StatisticController::class, 'filterGangMember'])->name('statistic.filterGangMember');
    Route::get('age', [StatisticController::class, 'filterAge'])->name('statistic.filterAge');
});

Route::get('/activation/{token}', [RegisteredUserController::class, 'activation'])->name('index.activation');
Route::post('/activation', [RegisteredUserController::class, 'activationAccount'])->name('index.activationAccount');
Route::get('/user-reset-password/{token}', [PasswordResetLinkController::class, 'resetPasswordPage'])->name('index.resetPasswordPage');
Route::post('/user-reset-password', [PasswordResetLinkController::class, 'resetPassword'])->name('index.userResetPassword');

Route::middleware('auth')->group(function () {

    Route::get('get-select-provinces', [LaravoltDataController::class, 'selectProvince'])->name('provinces.select');
    Route::get('get-select-cities', [LaravoltDataController::class, 'selectCity'])->name('cities.select');
    Route::get('get-select-districts', [LaravoltDataController::class, 'selectDistrict'])->name('districts.select');
    Route::get('get-select-villages', [LaravoltDataController::class, 'selectVillage'])->name('villages.select');

    Route::get('/rangkuman', [HomeController::class, 'indexRangkuman'])->name('index.Rangkuman');
    Route::get('/rangkuman-mobile', [HomeController::class, 'RangkumanMobile'])->name('index.RangkumanMobile');
    Route::get('/get-list-polsek', [HomeController::class, 'listPolsek'])->name('index.ListPolsek');

    // Account pages
    Route::prefix('account')->group(function () {
        Route::get('perpetrator/{id}', [PerpetratorController::class, 'detail'])->name('perpetrator.detail');
        Route::get('perpetrator/offender/{id}/edit', [PerpetratorController::class, 'editOffender'])->name('perpetrator.editOffender');
        Route::post('perpetrator/offender-create', [PerpetratorController::class, 'addOffender'])->name('perpetrator.addOffender');
        Route::get('perpetrator/offender-create/{perpetrator}/{type}', [PerpetratorController::class, 'addOffenderMobile'])->name('perpetrator.addOffenderMobile');
        Route::get('perpetrator/offender/{id}/create', [PerpetratorController::class, 'createOffenderForm'])->name('perpetrator.createOffenderForm');
        Route::put('perpetrator/offender/create-data-kejadian', [PerpetratorController::class, 'updateDataKejadian'])->name('perpetrator.updateDataKejadian');
        Route::put('perpetrator/offender', [PerpetratorController::class, 'updateOffender'])->name('perpetrator.updateOffender');
        Route::get('perpetrator/delete/{id}', [PerpetratorController::class, 'deleteOffender'])->name('perpetrator.deleteOffender');
        Route::get('perpetrator/edit-profile/{id}', [PerpetratorController::class, 'editProfile'])->name('perpetrator.editProfile');
        Route::put('perpetrator/update-profile', [PerpetratorController::class, 'updateProfile'])->name('perpetrator.updateProfile');

        Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');
        Route::put('settings/email', [SettingsController::class, 'changeEmail'])->name('settings.changeEmail');
        Route::put('settings/password', [SettingsController::class, 'changePassword'])->name('settings.changePassword');
        Route::get('settings/data-umum/{id}', [SettingsController::class, 'indexDataUmum'])->name('settings.dataUmum');
        Route::put('settings/data-umum', [SettingsController::class, 'updateDataUmum'])->name('settings.updateDataUmum');
        Route::get('settings/data-pribadi/{id}/perpetrator/{perpetrator_id}', [SettingsController::class, 'indexDataPribadi'])->name('settings.dataPribadi');
        Route::put('settings/data-pribadi', [SettingsController::class, 'updateDataPribadi'])->name('settings.updateDataPribadi');
        Route::get('settings/data-kejadian/{id}/perpetrator/{perpetrator_id}', [SettingsController::class, 'indexDataKejadian'])->name('settings.dataKejadian');
        Route::put('settings/data-kejadian', [SettingsController::class, 'updateDataKejadian'])->name('settings.updateDataKejadian');
    });

    Route::prefix('offenders')->group(function () {
        Route::post('create', [OffenderController::class, 'createOffender'])->name('offender.create');
        Route::get('index', [OffenderController::class, 'index']);
        Route::get('list', [OffenderController::class, 'getPerpetrators'])->name('perpetrator.list');
        Route::get('createOffrenders/{offender_type}', [OffenderController::class, 'createOffenders'])->name('offender_type');
    });

    // Logs pages
    Route::prefix('log')->name('log.')->group(function () {
        Route::resource('system', SystemLogsController::class)->only(['index', 'destroy']);
        Route::resource('audit', AuditLogsController::class)->only(['index', 'destroy']);
        Route::resource('perpetrator', PerpetratorsController::class)->only(['index']);
        Route::get('perpetrator/delete/{id}', [PerpetratorController::class, 'deletePerpetrator'])->name('deletePerpetrator');
    });

    // User pages
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('index', [SettingsController::class, 'index'])->name('user.index');
    });

    // Logs pages
    Route::prefix('log')->name('log.')->group(function () {
        Route::resource('system', SystemLogsController::class)->only(['index', 'destroy']);
        Route::resource('audit', AuditLogsController::class)->only(['index', 'destroy']);
        Route::resource('perpetrator', PerpetratorsController::class)->only(['index']);
    });

    Route::resource('data_kasus', ListDataKasusController::class);

    Route::resource('user_role', UserRoleController::class);
    Route::post('polsek', [UserRoleController::class, 'list_polsek'])->name('user_role.polsek');
    Route::get('delete/{id}', [UserRoleController::class, 'delete'])->name('user_role.delete');

    Route::resource('users', UsersController::class);
});



/**
 * Socialite login using Google service
 * https://laravel.com/docs/8.x/socialite
 */
Route::get('/auth/redirect/{provider}', [SocialiteLoginController::class, 'redirect']);

require __DIR__ . '/auth.php';
