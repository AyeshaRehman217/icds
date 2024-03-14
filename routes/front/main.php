<?php


use App\Http\Controllers\Front\AboutUsController;
use App\Http\Controllers\Front\DateController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\Icds2021Controller;
use App\Http\Controllers\Front\Icds2022Controller;
use App\Http\Controllers\Front\RegistrationController;
use App\Http\Controllers\Front\SpeakerController;
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
    Route::get('home',[HomeController::class, 'index'])->name('home');
    Route::get('date',[DateController::class, 'index'])->name('date');
    Route::get('about-us',[AboutUsController::class, 'index'])->name('about-us');
    Route::get('speaker',[SpeakerController::class, 'index'])->name('speaker');
    Route::get('icds-2022',[Icds2022Controller::class, 'index'])->name('icds-2022');
    Route::get('icds-2021',[Icds2021Controller::class, 'index'])->name('icds-2021');
    Route::get('registration',[RegistrationController::class, 'index'])->name('registration');
  
    // Route::group(['prefix' => 'front','as' => 'front.'], function() {
    Route::post('registration-store',[RegistrationController::class, 'store'])->name('registration-store');
    Route::get('get-countries-select',[RegistrationController::class,'getCountryIndexSelect'])->name('get.countries-select');
    Route::get('get-states-select',[RegistrationController::class,'getStateIndexSelect'])->name('get.states-select');
    Route::get('get-cities-select',[RegistrationController::class,'getCityIndexSelect'])->name('get.cities-select');
    Route::get('get-registration-type-select',[RegistrationController::class,'getIndexRegistrationTypeSelect'])->name('get.registration-type-select');
    Route::get('get-payment-type-select',[RegistrationController::class,'getIndexPaymentTypeSelect'])->name('get.payment-type-select');
    

// });



