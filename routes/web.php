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
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ReportController;

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
Route::get('/dashboard', [IndexController::class, 'dashboard'])->name('index.dashboard');

//store & update,show

//auth
Route::get('authenticationkey/show', [AuthenticationKeysController::class, 'index'])->name('authenticationkey.index');
Route::post('authenticationkey/store', [AuthenticationKeysController::class, 'store'])->name('authenticationkey.store');
Route::get('authentication/show', [AuthenticationsController::class, 'index'])->name('authentication.index');
Route::post('authentication/store', [AuthenticationsController::class, 'store'])->name('authentication.store');

//role
Route::get('role/show', [RolesController::class, 'index'])->name('role.index');
Route::post('role/store', [RolesController::class, 'store'])->name('role.store');

//setting
Route::get('setting/show', [SettingsController::class, 'index'])->name('setting.index');
Route::post('setting/store', [SettingsController::class, 'store'])->name('setting.store');

//blacklist
Route::get('blacklist/show', [BlackListsController::class, 'index'])->name('blacklist.index');
Route::post('blacklist/store', [BlackListsController::class, 'store'])->name('blacklist.store');
Route::get('blacklisttype/show', [BlackListTypesController::class, 'index'])->name('blacklisttype.index');
Route::post('blacklisttype/store', [BlackListTypesController::class, 'store'])->name('blacklisttype.store');

//loan
Route::get('loantype/show', [LoanTypesController::class, 'index'])->name('loantype.index');
Route::post('loantype/store', [LoanTypesController::class, 'store'])->name('loantype.store');
Route::get('loandetail/show', [LoanDetailsController::class, 'index'])->name('loandetail.index');
Route::post('loandetail/store', [LoanDetailsController::class, 'store'])->name('loandetail.store');
Route::get('loan/index', [LoansController::class, 'index'])->name('loan.index');
Route::get('loan/create', [LoansController::class, 'create'])->name('loan.create');
Route::post('loan/store', [LoansController::class, 'store'])->name('loan.store');
Route::get('loan/get-payment-detail', [LoansController::class, 'getLoanPaymentDetailAjax'])->name('loan.getLoanPaymentDetailAjax');


//payment
Route::get('paymenttype/show', [PaymentTypesController::class, 'index'])->name('paymenttype.index');
Route::post('paymenttype/store', [PaymentTypesController::class, 'store'])->name('paymenttype.store');
Route::get('completed-payment/view', [PaymentsController::class, 'index'])->name('payment.index');
Route::get('payment/ajax/view-by-loan', [PaymentsController::class, 'viewByLoanInAjax'])->name('payment.viewByLoanInAjax');
Route::get('payment/create/{id}', [PaymentsController::class, 'create'])->name('payment.create');
Route::post('payment/store', [PaymentsController::class, 'store'])->name('payment.store');
Route::get('payable/view', [PaymentsController::class, 'payable'])->name('payment.payable');
Route::get('payable/schedule', [PaymentsController::class, 'schedule'])->name('payment.schedule');
Route::get('active-loans', [PaymentsController::class, 'activeLoans'])->name('payment.activeLoans');
Route::post('collecter-payment/store', [PaymentsController::class, 'collecterPaymentStore'])->name('payment.collecterPaymentStore');

//master
Route::get('property/show', [PropertiesController::class, 'index'])->name('property.index');
Route::post('property/store', [PropertiesController::class, 'store'])->name('property.store');
Route::get('department/show', [departmentsController::class, 'index'])->name('department.index');
Route::post('department/store', [departmentsController::class, 'store'])->name('department.store');
Route::get('employee/show', [EmployeesController::class, 'index'])->name('employee.index');
Route::post('employee/store', [EmployeesController::class, 'store'])->name('employee.store');

// customer
Route::get('customer/show', [CustomersController::class, 'index'])->name('customer.index');
Route::post('customer/store', [CustomersController::class, 'store'])->name('customer.store');
Route::get('customer/status-change', [CustomersController::class, 'statusChange'])->name('customer.status-change');

//customer Type
Route::get('customertype/show', [CustomerTypesController::class, 'index'])->name('customertype.index');
Route::post('customertype/store', [CustomerTypesController::class, 'store'])->name('customertype.store');

Route::get('employee/status-change', [EmployeesController::class, 'statusChange'])->name('employee.status-change');



// report
Route::get('/collector-payment-view/report', [ReportController::class, 'collectorPaymentReport'])->name('collectorPaymentReport');