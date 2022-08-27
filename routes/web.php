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

//store and update
Route::get('authenticationkey/store', [AuthenticationKeysController::class, 'store'])->name('authenticationkey.store');
Route::get('authentication/store', [AuthenticationsController::class, 'store'])->name('authentication.store');
Route::get('blacklist/store', [BlackListsController::class, 'store'])->name('blacklist.store');
Route::get('blacklisttype/store', [BlackListTypesController::class, 'store'])->name('blacklisttype.store');

Route::get('customertype/store', [CustomerTypesController::class, 'store'])->name('customertype.store');
Route::get('department/store', [departmentsController::class, 'store'])->name('department.store');
Route::get('employee/store', [EmployeesController::class, 'store'])->name('employee.store');
Route::get('loandetail/store', [LoanDetailsController::class, 'store'])->name('loandetail.store');
Route::get('loan/store', [LoansController::class, 'store'])->name('loan.store');
Route::get('loantype/store', [LoanTypesController::class, 'store'])->name('loantype.store');
Route::get('payment/store', [PaymentsController::class, 'store'])->name('payment.store');
Route::get('property/store', [PropertiesController::class, 'store'])->name('property.store');
Route::get('role/store', [RolesController::class, 'store'])->name('role.store');
Route::get('setting/store', [SettingsController::class, 'store'])->name('setting.store');

//show
Route::get('authenticationkey/show', [AuthenticationKeysController::class, 'index'])->name('authenticationkey.index');
Route::get('authentication/show', [AuthenticationsController::class, 'index'])->name('authentication.index');
Route::get('blacklist/show', [BlackListsController::class, 'index'])->name('blacklist.index');
Route::get('blacklisttype/show', [BlackListTypesController::class, 'index'])->name('blacklisttype.index');
Route::get('customertype/show', [CustomerTypesController::class, 'index'])->name('customertype.index');
Route::get('department/show', [departmentsController::class, 'index'])->name('department.index');
Route::get('employee/show', [EmployeesController::class, 'index'])->name('employee.index');
Route::get('loandetail/show', [LoanDetailsController::class, 'index'])->name('loandetail.index');
Route::get('loan/show', [LoansController::class, 'index'])->name('loan.index');
Route::get('loantype/show', [LoanTypesController::class, 'index'])->name('loantype.index');
Route::get('payment/show', [PaymentsController::class, 'index'])->name('payment.index');
Route::get('property/show', [PropertiesController::class, 'index'])->name('property.index');
Route::get('role/show', [RolesController::class, 'index'])->name('role.index');
Route::get('setting/show', [SettingsController::class, 'index'])->name('setting.index');























// customer
Route::get('customer/index', [CustomersController::class, 'index'])->name('customer.index');
Route::post('customer/store', [CustomersController::class, 'store'])->name('customer.store');
Route::get('customer/status-change', [CustomersController::class, 'statusChange'])->name('customer.status-change');
