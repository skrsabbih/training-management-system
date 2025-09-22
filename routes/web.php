<?php


use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\AdminPermissionController;
use App\Http\Controllers\backend\AdminProfileController;
use App\Http\Controllers\backend\AdminRoleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
});

// admin login route
Route::get('/login', [AdminController::class, 'login'])->name('login');

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AdminController::class, 'destroy'])->name('logout');

    /*  control Profile */

    Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile');
    Route::post('/profile/store', [AdminProfileController::class, 'store'])->name('profile.store');
    Route::get('/setting', [AdminProfileController::class, 'setting'])->name('setting');
    Route::post('/password/setting', [AdminProfileController::class, 'passwordSetting'])->name('passwordSetting');

    /* User Management - Permission */
    Route::prefix('permissions')->name('permissions.')->group(function () {
        Route::get('/', [AdminPermissionController::class, 'index'])->name('index');
        Route::get('/create', [AdminPermissionController::class, 'create'])->name('create');
        Route::post('/', [AdminPermissionController::class, 'store'])->name('store');
        Route::get('/{id}', [AdminPermissionController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [AdminPermissionController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminPermissionController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminPermissionController::class, 'destroy'])->name('destroy');
    });

    /* User Management - Role */
    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('/', [AdminRoleController::class, 'index'])->name('index');
        Route::get('/create', [AdminRoleController::class, 'create'])->name('create');
        Route::post('/', [AdminRoleController::class, 'store'])->name('store');
        Route::get('/{id}', [AdminRoleController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [AdminRoleController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminRoleController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminRoleController::class, 'destroy'])->name('destroy');
    });
});

// Remove default view, replace with role-based redirect
Route::get('/dashboard', function () {
    $user = auth()->user();

    if (!$user) {
        return redirect('/login');
    }

    if ($user->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->hasRole('trainer')) {
        return redirect('/trainer/dashboard');
    } else {
        return redirect('/trainee/dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
