<?php

use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Twilio\TwiML\Video\Room;

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
Route::post('/CreateBooking',[App\Http\Controllers\BookingController::class,'bookservices'])->name('bookednow');


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/status',[App\Http\Controllers\StatusController::class,'showStatus'])->name('getStatus');
Route::post('/addstatus',[App\Http\Controllers\StatusController::class,'postStatus'])->name('addStatus');
Route::post('/editstatus',[App\Http\Controllers\StatusController::class,'editStatus'])->name('updateStatus');
Route::get('/deletestatus/{statusid}',[App\Http\Controllers\StatusController::class,'dropStatus'])->name('deleteStatus');

Route::get('/branches',[App\Http\Controllers\SRDBranchController::class,'showBranches'])->name('getbranches');
Route::post('/addbranch',[App\Http\Controllers\SRDBranchController::class,'postBranches'])->name('addBranches');
Route::post('/editbranch',[App\Http\Controllers\SRDBranchController::class,'editBranches'])->name('updateBranches');
Route::get('/deletebranch/{cid}',[App\Http\Controllers\SRDBranchController::class,'dropBranches'])->name('deleteBranches');

Route::get('designation',[App\Http\Controllers\DesignationController::class,'showDesignation'])->name('getdesignation');
Route::post('adddesignation',[App\Http\Controllers\DesignationController::class,'postDesignation'])->name('addDesignations');
Route::post('editdesignation',[App\Http\Controllers\DesignationController::class,'editDesigantions'])->name('updateDesignations');
Route::get('deletedesignation/{cid}',[App\Http\Controllers\DesignationController::class,'dropDesignation'])->name('deleteDesignations');

Route::get('salary',[App\Http\Controllers\SalaryGradeController::class,'showSalaries'])->name('getSalaries');
Route::post('addsalary',[App\Http\Controllers\SalaryGradeController::class,'addSalaries'])->name('addSalary');
Route::post('updatesalary',[App\Http\Controllers\SalaryGradeController::class,'editSalaries'])->name('updateSalary');
Route::get('deletesalary/{cid}',[App\Http\Controllers\SalaryGradeController::class,'dropSalaries'])->name('deleteSalary');

Route::get('useraccount',[App\Http\Controllers\UserAccountController::class,'showUserAccounts'])->name('addUserAccounts');
Route::post('adduseraccount',[App\Http\Controllers\UserAccountController::class,'addUserAccounts'])->name('addUserAccount');
Route::post('edituseraccount',[App\Http\Controllers\UserAccountController::class,'editUserAccounts'])->name('updateUserAccount');
Route::get('deleteuseraccount/{cid}',[App\Http\Controllers\UserAccountController::class,'deleteUserAccounts'])->name('deleteUserAccount');


Route::get('/classification',[App\Http\Controllers\AdminController::class, 'storeServicesClass'])->name('Classification');
Route::post('/storelassification',[App\Http\Controllers\AdminController::class,'postClassification'])->name('addClassification');
Route::post('/updateclassification',[App\Http\Controllers\AdminController::class,'editClassification'])->name('updateClassification');
Route::get('/deleteclassification/{cid}',[App\Http\Controllers\AdminController::class,'dropClassification'])->name('deleteClassification');

Route::get('/services',[App\Http\Controllers\AdminController::class, 'storeServices'])->name('Services');
Route::post('/addservices',[App\Http\Controllers\AdminController::class,'postServices'])->name('addServices');
Route::post('/editservices',[App\Http\Controllers\AdminController::class,'servicesUpdate'])->name('updateServices');
Route::get('/deleteservices/{sid}',[App\Http\Controllers\AdminController::class,'dropservices'])->name('deleteservices');


Route::get('/showemployee',[App\Http\Controllers\AdminController::class,'ShowEmployees'])->name('addEmployee');
Route::post('/store-mployee',[App\Http\Controllers\AdminController::class,'createEmployee'])->name('storeEmployee');
Route::post('/edit-employee',[App\Http\Controllers\AdminController::class,'updateEmployee'])->name('editEmployee');

Route::get('/deleteemploye/{eid}',[App\Http\Controllers\AdminController::class,'dropEmployee'])->name('deleteEmployee');

Route::get('/ShowBooking',[App\Http\Controllers\AdminBookingController::class,'viewbooking'])->name('showbooking');
Route::get('/viewBooking/{bid}',[App\Http\Controllers\AdminBookingController::class,'showbookingdetails'])->name('viewbookingdetails');
Route::post('/create-transaction-booking',[App\Http\Controllers\AdminBookingController::class,'updateBooking'])->name('createtnxnumber');

Route::get('/show-client-booking',[App\Http\Controllers\AdminBookingController::class,'viewClientBookings'])->name('showclientbooking');
Route::get('/view-client-booking-details/{cid}',[App\Http\Controllers\AdminBookingController::class,'showClientBookings'])->name('viewclientbookingdetails');
Route::get('/accept-client-booking/{bid}/{pid}',[App\Http\Controllers\AdminBookingController::class,'finishedClientsBooking'])->name('finishedbooking');

Route::post('/proceed-booking',[App\Http\Controllers\AdminBookingController::class,'proceedclientbookings'])->name('proceedclientbooking');

Route::get('/show-for-payment',[App\Http\Controllers\SRDSalesController::class,'viewForPayment'])->name('createPayment');
Route::post('/post-payment', [App\Http\Controllers\SRDSalesController::class, 'storePayment'])->name('postPayments');
Route::post('/save-payment',[App\Http\Controllers\SRDSalesController::class,'postPayment'])->name('savePayment');

Route::get('/viewClientBooking',[App\Http\Controllers\AdminBookingController::class,'ShowBookingUsers'])->name('usershowbooking');
Route::get('/viewClientServices',[App\Http\Controllers\AdminBookingController::class,'ShowBookingTech'])->name('techshowbooking');

Route::get('/viewSchedule',[App\Http\Controllers\AdminBookingController::class,'bookedschedule'])->name('scheduling');
Route::get('/View-Users',[App\Http\Controllers\ViewDataController::class,'viewEmployees'])->name('view-user-account');
Route::get('/View-Booking',[App\Http\Controllers\ViewDataController::class,'viewBookings'])->name('view-booking');


Route::controller(App\Http\Controllers\Auth\AuthOtpController::class)->group(function(){
    Route::get('otp/login', 'login')->name('otp.login');
    Route::post('otp/generate', 'generate')->name('otp.generate');
    Route::get('otp/verification/{user_id}', 'verification')->name('otp.verification');
    Route::post('otp/login', 'loginWithOtp')->name('otp.getlogin');
});

Route::post('/destroy/{user_id}',[App\Http\Controllers\Auth\LogoutController::class,'destroySession'])->name('logouts');

