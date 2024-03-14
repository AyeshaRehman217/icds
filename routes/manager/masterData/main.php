<?php

use App\Http\Controllers\Manager\MasterData\CityController;
use App\Http\Controllers\Manager\MasterData\CountryController;
use App\Http\Controllers\Manager\MasterData\PaymentTypeController;
use App\Http\Controllers\Manager\MasterData\RegionController;
use App\Http\Controllers\Manager\MasterData\RegistrationStatusController;
use App\Http\Controllers\Manager\MasterData\CertificateStatusController;
use App\Http\Controllers\Manager\MasterData\RegistrationTypeController;
use App\Http\Controllers\Manager\MasterData\SessionController;
use App\Http\Controllers\Manager\MasterData\StateController;
use App\Http\Controllers\Manager\MasterData\OnsiteSubmissionTypeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register backend web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the prefix "manager" middleware group. Now create something great!
|
*/
//Backend Routes
Route::group(['middleware' => ['auth','verified','xss','user.status','user.module:manager'], 'prefix' => 'manager','as' => 'manager.'], function() {

    // Session
    Route::resource('session', SessionController::class);
    Route::get('get-session', [SessionController::class, 'getIndex'])->name('get.session');
    Route::get('session/{sid}/user-registration', [SessionController::class, 'sessionRegistrations'])->name('get.session-user-registration');
    Route::get('get-session-select', [SessionController::class, 'getIndexSelectSession'])->name('get.session-select');
    Route::get('get-session-activity/{id}', [SessionController::class, 'getActivity'])->name('get.session-activity');
    Route::get('get-session-status/{id}', [SessionController::class, 'editStatus'])->name('get.session-status');
    Route::put('get-session-update-status/{id}', [SessionController::class, 'updateStatus'])->name('get.session-update-status');
    Route::get('get-session-activity-log/{id}', [SessionController::class, 'getActivityLog'])->name('get.session-activity-log');
    Route::get('get-session-activity-trash', [SessionController::class, 'getTrashActivity'])->name('get.session-activity-trash');
    Route::get('get-session-activity-trash-log', [SessionController::class, 'getTrashActivityLog'])->name('get.session-activity-trash-log');

    // Registration Type
    Route::resource('registration-type', RegistrationTypeController::class);
    Route::get('get-registration-type', [RegistrationTypeController::class, 'getIndex'])->name('get.registration-type');
    Route::get('get-registration-type-select', [RegistrationTypeController::class, 'getIndexRegistrationTypeSelect'])->name('get.registration-type-select');
    Route::get('get-registration-type-activity/{id}', [RegistrationTypeController::class, 'getActivity'])->name('get.registration-type-activity');
    Route::get('get-registration-type-activity-log/{id}', [RegistrationTypeController::class, 'getActivityLog'])->name('get.registration-type-activity-log');
    Route::get('get-registration-type-activity-trash', [RegistrationTypeController::class, 'getTrashActivity'])->name('get.registration-type-activity-trash');
    Route::get('get-registration-type-activity-trash-log', [RegistrationTypeController::class, 'getTrashActivityLog'])->name('get.registration-type-activity-trash-log');

    // Payment Type
    Route::resource('payment-type', PaymentTypeController::class);
    Route::get('get-payment-type', [PaymentTypeController::class, 'getIndex'])->name('get.payment-type');
    Route::get('get-payment-type-select', [PaymentTypeController::class, 'getIndexPaymentTypeSelect'])->name('get.payment-type-select');
    Route::get('get-payment-type-activity/{id}', [PaymentTypeController::class, 'getActivity'])->name('get.payment-type-activity');
    Route::get('get-payment-type-activity-log/{id}', [PaymentTypeController::class, 'getActivityLog'])->name('get.payment-type-activity-log');
    Route::get('get-payment-type-activity-trash', [PaymentTypeController::class, 'getTrashActivity'])->name('get.payment-type-activity-trash');
    Route::get('get-payment-type-activity-trash-log', [PaymentTypeController::class, 'getTrashActivityLog'])->name('get.payment-type-activity-trash-log');

    // Registration Status
    Route::resource('registration-status', RegistrationStatusController::class);
    Route::get('get-registration-status', [RegistrationStatusController::class, 'getIndex'])->name('get.registration-status');
    Route::get('get-registration-status-select', [RegistrationStatusController::class, 'getIndexRegistrationStatusSelect'])->name('get.registration-status-select');
    Route::get('get-registration-status-activity/{id}', [RegistrationStatusController::class, 'getActivity'])->name('get.registration-status-activity');
    Route::get('get-registration-status-activity-log/{id}', [RegistrationStatusController::class, 'getActivityLog'])->name('get.registration-status-activity-log');
    Route::get('get-registration-status-activity-trash', [RegistrationStatusController::class, 'getTrashActivity'])->name('get.registration-status-activity-trash');
    Route::get('get-registration-status-activity-trash-log', [RegistrationStatusController::class, 'getTrashActivityLog'])->name('get.registration-status-activity-trash-log');
    // Certificate Staus
    Route::get('get-certificate-status-select', [CertificateStatusController::class, 'getIndexCertificateStatusSelect'])->name('get.certificate-status-select');

    // Region
    Route::resource('region', RegionController::class);
    Route::get('get-region', [RegionController::class, 'getIndex'])->name('get.region');
//    Route::get('get-region-select', [RegionController::class, 'getIndexSelect'])->name('get.region-select');
    Route::get('get-region-activity/{id}', [RegionController::class, 'getActivity'])->name('get.region-activity');
    Route::get('get-region-activity-log/{id}', [RegionController::class, 'getActivityLog'])->name('get.region-activity-log');
    Route::get('get-region-activity-trash', [RegionController::class, 'getTrashActivity'])->name('get.region-activity-trash');
    Route::get('get-region-activity-trash-log', [RegionController::class, 'getTrashActivityLog'])->name('get.region-activity-trash-log');

    // Country
    Route::get('get-country-select', [CountryController::class, 'getCountryIndexSelect'])->name('get.country-select');

    // State
    Route::get('get-state-select', [StateController::class, 'getStateIndexSelect'])->name('get.state-select');

    // City
    Route::get('get-city-select', [CityController::class, 'getCityIndexSelect'])->name('get.city-select');

    Route::get('get-submission-type-select', [OnsiteSubmissionTypeController::class, 'getIndexSubmissionTypeSelect'])->name('get.submission-type-select');
});


