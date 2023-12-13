<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [PostController::class, 'display']);


Route::get('/dashboard', function () {
    if (Auth::check()) {
        $user = Auth::user();
        $role = $user->role;

        if ($role === 'admin') {
            return view('admin.dashboard'); 
        } elseif ($role === 'user') {
            return view('user.dashboard'); 
        }
    }

    return redirect('/login');
});


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'showLoginForm'])->name('register');
Route::post('/register', [LoginController::class, 'register']);

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'admin', 'middleware' => 'role:admin'], function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        
    });

    Route::group(['prefix' => 'user', 'middleware' => 'role:user'], function () {
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

        Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('profile.edit');
        Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
        Route::put('/password/update', [UserController::class, 'updatePassword'])->name('password.update');

        Route::get('/post', [PostController::class, 'index'])->name('post.index');
        Route::get('/post-create', [PostController::class, 'create'])->name('post.create');
        Route::match(['post', 'put'], '/post-process/{id?}', [PostController::class, 'process'])->name('post.process');
        Route::get('/post-edit/{id}', [PostController::class, 'edit'])->name('post.edit');
        Route::delete('/post-destroy/{id}', [PostController::class, 'destroy'])->name('post.destroy');


    });
});