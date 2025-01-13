<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AcademicianController;
use App\Http\Controllers\GrantController;
use App\Http\Controllers\MilestoneController;
use App\Http\Controllers\DashboardController;

// Home Routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login'); // Redirect to the login page after logout
})->name('logout');

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Resource Routes
//Route::resource('grants', GrantController::class);
//Route::resource('academicians', AcademicianController::class);
//Route::resource('milestones', MilestoneController::class);

Route::middleware(['can:AdminStaffAcademician'])->group(function () {
    Route::resource('grants', GrantController::class);
    Route::resource('academicians', AcademicianController::class);
    Route::resource('milestones', MilestoneController::class);
});
Route::get('/grants/{grant}', [GrantController::class, 'show'])->name('grants.show');
// Nested Routes for Milestones under Grants
/*Route::prefix('grants/{grant}')->group(function () {
    Route::get('milestones', [MilestoneController::class, 'index'])->name('milestones.index');
    Route::get('milestones/create', [MilestoneController::class, 'create'])->name('milestones.create');
    Route::post('milestones', [MilestoneController::class, 'store'])->name('milestones.store');
    Route::get('milestones/{milestone}/edit', [MilestoneController::class, 'edit'])->name('milestones.edit');
    Route::put('milestones/{milestone}', [MilestoneController::class, 'update'])->name('milestones.update');
    Route::delete('milestones/{milestone}', [MilestoneController::class, 'destroy'])->name('milestones.destroy');
});*/
