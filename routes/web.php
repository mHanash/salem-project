<?php

use App\Http\Controllers\BeneficiaryController;
use App\Http\Controllers\BudgetingController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LineBudgetingController;
use App\Http\Controllers\RepportingController;
use App\Http\Controllers\RubriqueController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TypeBeneficiaryController;
use App\Http\Controllers\TypeRubriqueController;
use App\Http\Controllers\YearController;
use App\Models\Budgeting;
use Illuminate\Support\Facades\Route;

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
    return view('home');
})->name('home');

Route::get('type_beneficiary', [TypeBeneficiaryController::class, 'index'])->name('typeBeneficiaries');
Route::post('type_beneficiary', [TypeBeneficiaryController::class, 'store'])->name('typeBeneficiaries.store');
Route::delete('type_beneficiary/{id}', [TypeBeneficiaryController::class, 'destroy'])->name('typeBeneficiaries.destroy');
Route::get('type_beneficiary/{id}', [TypeBeneficiaryController::class, 'show'])->name('typeBeneficiaries.show');
Route::post('type_beneficiary/update/{id}', [TypeBeneficiaryController::class, 'update'])->name('typeBeneficiaries.update');

Route::get('beneficiaries', [BeneficiaryController::class, 'index'])->name('beneficiaries');
Route::post('beneficiaries', [BeneficiaryController::class, 'store'])->name('beneficiaries.store');
Route::delete('beneficiaries/{id}', [BeneficiaryController::class, 'destroy'])->name('beneficiaries.destroy');
Route::get('beneficiaries/{id}', [BeneficiaryController::class, 'show'])->name('beneficiaries.show');
Route::post('beneficiaries/update/{id}', [BeneficiaryController::class, 'update'])->name('beneficiaries.update');

Route::get('job', [JobController::class, 'index'])->name('jobs');
Route::post('job', [JobController::class, 'store'])->name('jobs.store');
Route::delete('job/{id}', [JobController::class, 'destroy'])->name('jobs.destroy');
Route::get('job/{id}', [JobController::class, 'show'])->name('jobs.show');
Route::post('job/update/{id}', [JobController::class, 'update'])->name('jobs.update');

Route::get('type_account', [TypeRubriqueController::class, 'index'])->name('typeAccounts');
Route::post('type_account', [TypeRubriqueController::class, 'store'])->name('typeAccounts.store');
Route::delete('type_account/{id}', [TypeRubriqueController::class, 'destroy'])->name('typeAccounts.destroy');
Route::get('type_account/{id}', [TypeRubriqueController::class, 'show'])->name('typeAccounts.show');
Route::post('type_account/update/{id}', [TypeRubriqueController::class, 'update'])->name('typeAccounts.update');

Route::get('currency', [CurrencyController::class, 'index'])->name('currencies');
Route::post('currency', [CurrencyController::class, 'store'])->name('currencies.store');
Route::delete('currency/{id}', [CurrencyController::class, 'destroy'])->name('currencies.destroy');
Route::get('currency/{id}', [CurrencyController::class, 'show'])->name('currencies.show');
Route::post('currency/update/{id}', [CurrencyController::class, 'update'])->name('currencies.update');

Route::get('accounts', [RubriqueController::class, 'index'])->name('accounts');
Route::post('accounts', [RubriqueController::class, 'store'])->name('accounts.store');
Route::delete('accounts/{id}', [RubriqueController::class, 'destroy'])->name('accounts.destroy');
Route::get('accounts/{id}', [RubriqueController::class, 'show'])->name('accounts.show');
Route::post('accounts/update/{id}', [RubriqueController::class, 'update'])->name('accounts.update');

Route::get('transaction/{id}', [TransactionController::class, 'show'])->name('transactions.show')->where('id', '[0-9]+');
Route::get('transaction/details/{id}', [TransactionController::class, 'index'])->name('transactions')->where('id', '[0-9]+');
Route::post('transaction/update/{id}', [TransactionController::class, 'update'])->name('transactions.update')->where('id', '[0-9]+');
Route::get('transaction/home', [TransactionController::class, 'home'])->name('transactions.home');
Route::post('transaction', [TransactionController::class, 'store'])->name('transactions.store');
Route::delete('transaction/{id}', [TransactionController::class, 'destroy'])->name('transactions.destroy');

Route::get('budgeting', [BudgetingController::class, 'index'])->name('budgetings');
Route::post('budgeting', [BudgetingController::class, 'store'])->name('budgetings.store');
Route::delete('budgeting/{id}', [BudgetingController::class, 'destroy'])->name('budgetings.destroy');
Route::get('budgeting/{id}', [BudgetingController::class, 'show'])->name('budgetings.show');
Route::post('budgeting/update/{id}', [BudgetingController::class, 'update'])->name('budgetings.update');

Route::get('status', [StatusController::class, 'index'])->name('status');
Route::post('status', [StatusController::class, 'store'])->name('status.store');
Route::delete('status/{id}', [StatusController::class, 'destroy'])->name('status.destroy');
Route::get('status/{id}', [StatusController::class, 'show'])->name('status.show');
Route::post('status/update/{id}', [StatusController::class, 'update'])->name('status.update');

Route::get('years', [YearController::class, 'index'])->name('years');
Route::post('years', [YearController::class, 'store'])->name('years.store');
Route::delete('years/{id}', [YearController::class, 'destroy'])->name('years.destroy');
Route::get('years/{id}', [YearController::class, 'show'])->name('years.show');
Route::post('years/update/{id}', [YearController::class, 'update'])->name('years.update');

Route::get('planning/details/{id}', [LineBudgetingController::class, 'index'])->name('plannings');
Route::get('planning/home', [LineBudgetingController::class, 'home'])->name('plannings.home');
Route::post('planning', [LineBudgetingController::class, 'store'])->name('plannings.store');
Route::delete('planning/{id}', [LineBudgetingController::class, 'destroy'])->name('plannings.destroy');
Route::get('planning/{id}', [LineBudgetingController::class, 'show'])->name('plannings.show');
Route::post('planning/update/{id}', [LineBudgetingController::class, 'update'])->name('plannings.update')->where('id', '[0-9]+');

Route::get('repporting/details/{id}', [RepportingController::class, 'index'])->name('repportings');
Route::get('repporting/home', [RepportingController::class, 'home'])->name('repportings.home');
Route::post('repporting', [RepportingController::class, 'store'])->name('repportings.store');
Route::delete('repporting/{id}', [RepportingController::class, 'destroy'])->name('repportings.destroy');
Route::get('repporting/{id}', [RepportingController::class, 'show'])->name('repportings.show');
Route::post('repporting/update/{id}', [RepportingController::class, 'update'])->name('repportings.update')->where('id', '[0-9]+');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';
