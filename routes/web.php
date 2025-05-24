<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->group(function(){
    Route::match(['get', 'post'],'login', [AdminController::class, 'login']);
    Route::group(['middleware'=> ['admin']], function(){
        Route::get('dasboard', [AdminController::class, 'dasboard']);
        //Update Admin password
        Route::match(['get', 'post'], 'update_password', [AdminController::class, 'updatePassword']);
        //check admin password
        Route::post('/check-admin-password', [AdminController::class, 'checkAdminPassword']);

        //Admin Logout
        Route::get('logout', [AdminController::class, 'logout']);
    });
    
});

require __DIR__.'/auth.php';

