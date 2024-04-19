<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\GaleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\JamBukaController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\TestimoniController;
use Illuminate\Support\Facades\Auth;
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


Route::group(['middleware' => 'auth'], function () {

	Route::get('/', function () {
		if (Auth::user()) {
			return redirect('/login');
		}
	
	})->name('dashboard');

	Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
	
	Route::get('/testimoni', [TestimoniController::class, 'index'])->name('testimoni');
	Route::post('/testimoni-store', [TestimoniController::class, 'store'])->name('testimoni-store');
	Route::post('/testimoni-update/{id}', [TestimoniController::class, 'update'])->name('testimoni-update');
	Route::get('/testimoni-delete/{id}', [TestimoniController::class, 'destroy'])->name('testimoni-delete');
	
	Route::get('/galery', [GaleryController::class, 'index'])->name('galery');
	Route::post('/galery-store', [GaleryController::class, 'store'])->name('galery-store');
	Route::post('/galery-update/{id}', [GaleryController::class, 'update'])->name('galery-update');
	Route::get('/galery-delete/{id}', [GaleryController::class, 'destroy'])->name('galery-delete');

	Route::get('/category', [CategoryController::class, 'index'])->name('category');
	Route::post('/category-store', [CategoryController::class, 'store'])->name('category-store');
	Route::post('/category-update/{id}', [CategoryController::class, 'update'])->name('category-update');
	Route::get('/category-delete/{id}', [CategoryController::class, 'destroy'])->name('category-delete');

	Route::get('/jam-buka', [JamBukaController::class, 'index'])->name('jam-buka');
	Route::post('/jam-buka-store', [JamBukaController::class, 'store'])->name('jam-buka-store');
	Route::post('/jam-buka-update/{id}', [JamBukaController::class, 'update'])->name('jam-buka-update');
	Route::get('/jam-buka-delete/{id}', [JamBukaController::class, 'destroy'])->name('jam-buka-delete');

    Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-management', [InfoUserController::class, 'userManagement'])->name('user-management');
	Route::post('/tambah-user', [InfoUserController::class, 'tambahUser'])->name('tambah-user');
	Route::post('/update-user/{id}', [InfoUserController::class, 'updateUser'])->name('update-user');
	Route::get('/delete-user/{id}', [InfoUserController::class, 'deleteUser'])->name('delete-user');
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');
});



Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/login-post', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');