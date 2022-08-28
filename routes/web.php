<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthenticationKeysController;
use App\Http\Controllers\AuthenticationsController;
use App\Http\Controllers\BlackListsController;
use App\Http\Controllers\BlackListTypesController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\CustomerTypesController;
use App\Http\Controllers\departmentsController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\LoanDetailsController;
use App\Http\Controllers\LoansController;
use App\Http\Controllers\LoanTypesController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\PaymentTypesController;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SettingsController;


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

Route::get('/', function () {
    return view('pages.index');
});
// Route::get('/index', [IndexController::class, 'index'])->name('index');

//store & update,show

//auth
Route::get('authenticationkey/show', [AuthenticationKeysController::class, 'index'])->name('authenticationkey.index');
Route::get('authenticationkey/store', [AuthenticationKeysController::class, 'store'])->name('authenticationkey.store');
Route::get('authentication/show', [AuthenticationsController::class, 'index'])->name('authentication.index');
Route::get('authentication/store', [AuthenticationsController::class, 'store'])->name('authentication.store');

//role
Route::get('role/show', [RolesController::class, 'index'])->name('role.index');
Route::get('role/store', [RolesController::class, 'store'])->name('role.store');

//setting
Route::get('setting/show', [SettingsController::class, 'index'])->name('setting.index');
Route::get('setting/store', [SettingsController::class, 'store'])->name('setting.store');

//blacklist
Route::get('blacklist/show', [BlackListsController::class, 'index'])->name('blacklist.index');
Route::get('blacklist/store', [BlackListsController::class, 'store'])->name('blacklist.store');
Route::get('blacklisttype/show', [BlackListTypesController::class, 'index'])->name('blacklisttype.index');
Route::get('blacklisttype/store', [BlackListTypesController::class, 'store'])->name('blacklisttype.store');

//loan
Route::get('loantype/show', [LoanTypesController::class, 'index'])->name('loantype.index');
Route::get('loantype/store', [LoanTypesController::class, 'store'])->name('loantype.store');
Route::get('loandetail/show', [LoanDetailsController::class, 'index'])->name('loandetail.index');
Route::get('loandetail/store', [LoanDetailsController::class, 'store'])->name('loandetail.store');
Route::get('loan/index', [LoansController::class, 'index'])->name('loan.index');
Route::get('loan/create', [LoansController::class, 'create'])->name('loan.create');
Route::post('loan/store', [LoansController::class, 'store'])->name('loan.store');
Route::get('loan/get-payment-detail', [LoansController::class, 'getLoanPaymentDetailAjax'])->name('loan.getLoanPaymentDetailAjax');


//payment
Route::get('paymenttype/show', [PaymentsController::class, 'index'])->name('paymenttype.index');
Route::get('paymenttype/store', [PaymentsController::class, 'store'])->name('paymenttype.store');
Route::get('payment/show', [PaymentsController::class, 'index'])->name('payment.index');
Route::get('payment/store', [PaymentsController::class, 'store'])->name('payment.store');

//master
Route::get('property/show', [PropertiesController::class, 'index'])->name('property.index');
Route::get('property/store', [PropertiesController::class, 'store'])->name('property.store');
Route::get('department/show', [departmentsController::class, 'index'])->name('department.index');
Route::get('department/store', [departmentsController::class, 'store'])->name('department.store');
Route::get('employee/show', [EmployeesController::class, 'index'])->name('employee.index');
Route::get('employee/store', [EmployeesController::class, 'store'])->name('employee.store');

// customer
Route::get('customer/show', [CustomersController::class, 'index'])->name('customer.index');
Route::post('customer/store', [CustomersController::class, 'store'])->name('customer.store');
Route::get('customer/status-change', [CustomersController::class, 'statusChange'])->name('customer.status-change');

//customer Type
Route::get('customertype/show', [CustomerTypesController::class, 'index'])->name('customertype.index');
Route::get('customertype/store', [CustomerTypesController::class, 'store'])->name('customertype.store');

