<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\TypeBeneficiaryController;
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

Route::get('job', [JobController::class, 'index'])->name('jobs');
Route::post('job', [JobController::class, 'store'])->name('jobs.store');
Route::delete('job/{id}', [JobController::class, 'destroy'])->name('jobs.destroy');
Route::get('job/{id}', [JobController::class, 'show'])->name('jobs.show');
Route::post('job/update/{id}', [JobController::class, 'update'])->name('jobs.update');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';
