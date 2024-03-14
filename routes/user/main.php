<?php

use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\profile\ProfileController;
use App\Http\Controllers\User\Registration\UserRegistrationController;
use App\Http\Controllers\User\Registration\AbstractSubmissionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register backend web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the prefix "admin" middleware group. Now create something great!
|
*/


//Backend Routes
Route::group(['middleware' => ['auth', 'verified', 'xss', 'user.status', 'user.module:user'], 'prefix' => 'user', 'as' => 'user.'], function () {
//Profile
    Route::get('profile/{id}', [ProfileController::class, 'edit'])->name('profile');
    Route::put('profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('profile-image/{id}', [ProfileController::class, 'getImage'])->name('profile.get.image');

    //Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('user-registration', [UserRegistrationController::class, 'index'])->name('user-registration');
    Route::get('get-user-registration', [UserRegistrationController::class, 'getIndex'])->name('get.user-registration');
    Route::get('get-user-registration-status/{id}', [UserRegistrationController::class, 'editStatus'])->name('get.user-registration-status');

// Abstract Submission Route
    Route::resource('abstract-submission', AbstractSubmissionController::class);
    Route::get('get-abstract-submission', [AbstractSubmissionController::class, 'getIndex'])->name('get.abstract-submission');
    Route::get('get-registration-status-select', [AbstractSubmissionController::class, 'getRegistrationStatusIndex'])->name('get.registration-status-select');
    Route::get('get-abstract-submission-status/{id}', [AbstractSubmissionController::class, 'editStatus'])->name('get.abstract-submission-status');
    Route::put('get-abstract-submission-update-status/{id}', [AbstractSubmissionController::class, 'updateStatus'])->name('get.abstract-submission-update-status');
    Route::get('get-abstract-submission-activity/{id}', [AbstractSubmissionController::class, 'getActivity'])->name('get.abstract-submission-activity');
    Route::get('get-abstract-submission-activity-log/{id}', [AbstractSubmissionController::class, 'getActivityLog'])->name('get.abstract-submission-activity-log');
    Route::get('get-abstract-submission-activity-trash', [AbstractSubmissionController::class, 'getTrashActivity'])->name('get.abstract-submission-activity-trash');
    Route::get('get-abstract-submission-activity-trash-log', [AbstractSubmissionController::class, 'getTrashActivityLog'])->name('get.abstract-submission-activity-trash-log');
    Route::get('abstract-file/{id}',[AbstractSubmissionController::class,'getImage'])->name('abstract-file');

    Route::get('download-voucher/{id}', [UserRegistrationController::class, 'voucher'])->name('download-voucher');
    Route::get('download-gate-pass/{id}', [UserRegistrationController::class, 'gatePass'])->name('download-gate-pass');
    Route::get('download-certificate/{id}', [UserRegistrationController::class, 'certificate'])->name('download-certificate');
    Route::put('upload-voucher/{id}', [UserRegistrationController::class, 'upload'])->name('upload-voucher');
    Route::get('voucher-image/{id}',[UserRegistrationController::class,'getImage'])->name('get.voucher-image');

});


