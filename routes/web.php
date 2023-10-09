<?php

use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/',[App\Http\Controllers\AdminController::class,'showIndex'])->name('index');
Route::get('About Us',[App\Http\Controllers\AdminController::class,'showAbout'])->name('about');
Route::get('Services',[App\Http\Controllers\AdminController::class,'showServices'])->name('services');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/classification',[App\Http\Controllers\AdminController::class, 'storeServicesClass'])->name('Classification');

Route::post('/storelassification',[App\Http\Controllers\AdminController::class,'postClassification'])->name('addClassification');
Route::post('/updateclassification',[App\Http\Controllers\AdminController::class,'editClassification'])->name('updateClassification');
Route::post('/deleteclassification',[App\Http\Controllers\AdminController::class,'dropClassification'])->name('deleteClassification');

Route::get('/services',[App\Http\Controllers\AdminController::class, 'storeServices'])->name('Services');
Route::post('/addservices',[App\Http\Controllers\AdminController::class,'postServices'])->name('addServices');
Route::post('/editservices',[App\Http\Controllers\AdminController::class,'servicesUpdate'])->name('updateServices');
Route::post('/deleteservices',[App\Http\Controllers\AdminController::class,'dropservices'])->name('deleteservices');


Route::get('/showemployee',[App\Http\Controllers\AdminController::class,'ShowEmployees'])->name('addEmployee');
Route::post('/addemployee',[App\Http\Controllers\AdminController::class,'createEmployee'])->name('addemployee');


Route::controller(App\Http\Controllers\Auth\AuthOtpController::class)->group(function(){
    Route::get('otp/login', 'login')->name('otp.login');
    Route::post('otp/generate', 'generate')->name('otp.generate');
    Route::get('otp/verification/{user_id}', 'verification')->name('otp.verification');
    Route::post('otp/login', 'loginWithOtp')->name('otp.getlogin');
});



