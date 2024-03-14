<?php

use App\Http\Controllers\Manager\Registration\AbstractSubmissionController;
use App\Http\Controllers\Manager\Registration\UserRegistrationController;
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
Route::group(['middleware' => ['auth', 'verified', 'xss', 'user.status', 'user.module:manager'], 'prefix' => 'manager', 'as' => 'manager.'], function () {

    // User Registration
    Route::resource('session/{sid}/user-registration', UserRegistrationController::class, ['as' => 'session'] );
    Route::get('get-user-registration', [UserRegistrationController::class, 'getIndex'])->name('get.user-registration');
//    Route::get('get-user-registration-select', UserRegistrationController::class, 'getIndexSelect'])->name('get.user-registration-select');
    Route::get('session/{sid}/get-user-registration-status/{id}', [UserRegistrationController::class, 'editStatus'])->name('get.user-registration-status');
    Route::put('session/{sid}/get-user-registration-update-status/{id}', [UserRegistrationController::class, 'updateStatus'])->name('get.user-registration-update-status');
    Route::get('session/{sid}/get-user-registration-certificate-status/{id}', [UserRegistrationController::class, 'editCertificateStatus'])->name('get.user-registration-certificate-status');
    Route::put('session/{sid}/get-user-registration-update-certificate-status/{id}', [UserRegistrationController::class, 'updateCertificateStatus'])->name('get.user-registration-update-certificate-status');
    Route::get('session/{sid}/get-user-registration-activity/{id}', [UserRegistrationController::class, 'getActivity'])->name('get.user-registration-activity');
    Route::get('get-user-registration-activity-log/{id}', [UserRegistrationController::class, 'getActivityLog'])->name('get.user-registration-activity-log');
    Route::get('session/{sid}/get-user-registration-activity-trash', [UserRegistrationController::class, 'getTrashActivity'])->name('get.user-registration-activity-trash');
    Route::get('get-user-registration-activity-trash-log', [UserRegistrationController::class, 'getTrashActivityLog'])->name('get.user-registration-activity-trash-log');
    Route::get('get-user-registration-session-select', [UserRegistrationController::class, 'getSessionIndexSelect'])->name('get.user-registration-session-select');
    Route::get('user-registration-detail/{id}', [UserRegistrationController::class, 'detail','as' => 'session'])->name('user-registration-detail');

    // download & upload voucher
    Route::put('session/{sid}/upload-voucher/{id}', [UserRegistrationController::class, 'upload'])->name('upload-voucher');
    Route::get('download-voucher/{id}', [UserRegistrationController::class, 'voucher'])->name('download-voucher');
    Route::get('download-gate-pass/{id}', [UserRegistrationController::class, 'gatePass'])->name('download-gate-pass');
    Route::get('download-certificate/{id}', [UserRegistrationController::class, 'certificate'])->name('download-certificate');
    Route::get('voucher-image/{id}',[UserRegistrationController::class,'getImage'])->name('get.voucher-image');



    // Abstract Submission
    Route::resource('session/{sid}/user-registration/{uid}/abstract-submission', AbstractSubmissionController::class,['as' => 'session.user-registration']);
    Route::get('get-abstract-submission', [AbstractSubmissionController::class, 'getIndex'])->name('get.abstract-submission');
//    Route::get('get-abstract-submission-select', AbstractSubmissionController::class, 'getIndexSelect'])->name('get.abstract-submission-select');
    Route::get('session/{sid}/user-registration/{uid}/get-abstract-submission-status/{id}', [AbstractSubmissionController::class, 'editStatus'])->name('get.abstract-submission-status');
    Route::put('session/{sid}/user-registration/{uid}/get-abstract-submission-update-status/{id}', [AbstractSubmissionController::class, 'updateStatus'])->name('get.abstract-submission-update-status');
    Route::get('session/{sid}/user-registration/{uid}/get-abstract-submission-activity/{id}', [AbstractSubmissionController::class, 'getActivity'])->name('get.abstract-submission-activity');
    Route::get('get-abstract-submission-activity-log/{id}', [AbstractSubmissionController::class, 'getActivityLog'])->name('get.abstract-submission-activity-log');
    Route::get('session/{sid}/user-registration/{uid}/get-abstract-submission-activity-trash', [AbstractSubmissionController::class, 'getTrashActivity'])->name('get.abstract-submission-activity-trash');
    Route::get('get-abstract-submission-activity-trash-log', [AbstractSubmissionController::class, 'getTrashActivityLog'])->name('get.abstract-submission-activity-trash-log');
    Route::get('abstract-file/{id}',[AbstractSubmissionController::class,'getImage'])->name('abstract-file');
});


