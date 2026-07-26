<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SuperAdminCompanyController;
use App\Http\Controllers\Admin\ConversationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
    Route::resource('companies', CompanyController::class)->except(['show']);
    Route::resource('employees', EmployeeController::class)->except(['show']);
});

Route::prefix('conversations')->name('conversations.')->group(function () {
    Route::get('/', [ConversationController::class, 'index'])->name('index');
    Route::get('/create', [ConversationController::class, 'create'])->name('create');
    Route::post('/', [ConversationController::class, 'store'])->name('store');
    Route::get('/companies/{company}/users', [ConversationController::class, 'usersForCompany'])->name('users-for-company');
    Route::get('/{conversation}', [ConversationController::class, 'show'])->name('show');
    Route::post('/{conversation}/messages', [ConversationController::class, 'storeMessage'])->name('messages.store');
});

Route::middleware(['role:super_admin'])->prefix('super-admin')->name('super_admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'superAdmin'])->name('dashboard');
    Route::resource('admins', AdminController::class)->except(['show']);
    Route::resource('companies', SuperAdminCompanyController::class)->except(['show']);
});

require __DIR__ . '/auth.php';