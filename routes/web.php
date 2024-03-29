<?php

use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\EmployeesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect(route('employee.index'));
});

Auth::routes();

Route::resource('company', CompaniesController::class);
Route::get('/get-company', [CompaniesController::class, 'getCompanyOptions']);
Route::get('/get-company-detail', [CompaniesController::class, 'getCompanyDetail']);

Route::resource('employee', EmployeesController::class);
Route::get('/export-employee', [EmployeesController::class, 'exportEmployee'])->name('export-employee');
Route::post('/import-employee', [EmployeesController::class, 'importEmployee'])->name('import-employee');

