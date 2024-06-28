<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LegalCaseController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\UserController;
use App\Models\Lawyer;
use App\Models\LegalCase;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

// Preci u HomepageController
Route::get('/', function () {
    return view('/home');
})->name('home');
// Team / Lawyers - page display
Route::get('/lawyers', function () {
    $lawyers = Lawyer::all();
    $filePaths = File::glob(public_path('assets/img/team/*.jpg'));
    return view('team', ['lawyers' => $lawyers, 'filePaths' => $filePaths]);
})->name('team');
Route::get('about', function () {
    return view('about');
})->name('about');

// Security
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard routes
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::post('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // Legal case routes
    // Legal case - add - Client feature
    Route::post('/store', [LegalCaseController::class, 'store'])->name('store');

    // Legal case - Lawyer feature
    Route::get('/accept/{id}', [LegalCaseController::class, 'edit'])->name('accept');
    Route::get('/decline/{id}', [LegalCaseController::class, 'edit'])->name('decline');


    Route::group(['prefix' => 'case'], function () {
        // Legal case - display
        Route::get('/type/{param}', [LegalCaseController::class, 'index'])->name('type');
        Route::get('/status/{param}', [LegalCaseController::class, 'index'])->name('status');
        Route::get('/{param}', [LegalCaseController::class, 'index'])->name('caseall');
        // Legal case - display - one case
        Route::get('/details/{id}', [LegalCaseController::class, 'details'])->name('details');
    });

    // Note - feature
    Route::post('/note/add', [NoteController::class, 'store'])->name('add');

    // Appintments - feature
    Route::post('/appointment/add', [AppointmentController::class, 'store'])->name('appointment.add');
    Route::put('/appointment/{id}', [AppointmentController::class, 'update'])->name('appointment.update');
});

// Admin routes and security
Route::prefix('admin')->group(function () {
    Route::middleware(['guest:admin', 'auth:web', 'admin-role'])->group(function () {
        Route::get('/login', [AdminController::class, 'index'])->name('admin.login');
        Route::post('/login', [AdminController::class, 'login'])->name('admin.login.submit');
    });
    Route::middleware(['auth:admin', 'auth:web'])->group(function () {
        Route::get('/panel', [AdminController::class, 'show'])->name('admin.panel');
        Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::patch('/update', [AdminController::class, 'edit'])->name('admin.update');
    });
});

////////////////////////////////////////////////////////////////////////
// Add midleware and other stuff
Route::group(['prefix' => 'user'], function () {
    Route::get('/search/{f?}/{i?}', [UserController::class, 'index'])->name('user.search');
    Route::post('/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('user.delete');
});
/*
Route::get('/user/{param}', [AdminController::class, 'show'])->name('userall');
Route::get('/user/role/{param}', [AdminController::class, 'show'])->name('role');
Route::post('/user/{id}', [AdminController::class, 'update'])->name('save');
*/



require __DIR__ . '/auth.php';
