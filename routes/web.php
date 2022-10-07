<?php

use App\Http\Controllers\BeneficiaryController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\TypeBeneficiaryController;
use App\Http\Controllers\TypeRubriqueController;
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

Route::get('beneficiary', [BeneficiaryController::class, 'index'])->name('beneficiaries');
Route::post('beneficiary', [BeneficiaryController::class, 'store'])->name('beneficiaries.store');
Route::delete('beneficiary/{id}', [BeneficiaryController::class, 'destroy'])->name('beneficiaries.destroy');
Route::get('beneficiary/{id}', [BeneficiaryController::class, 'show'])->name('beneficiaries.show');
Route::post('beneficiary/update/{id}', [BeneficiaryController::class, 'update'])->name('beneficiaries.update');

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';
