<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){
        Route::get('/', function () {
            return view('welcome');
        });
    });

    Route::prefix('dashboard')->middleware(['auth', 'verified', 'dashbordAccess'])->name('dashboard.')->group(function () {

        Route::get('/', function () {
            return view('dash.index');
        })->name('main');

        Route::resources([
            'setting' => SettingController::class,
            'users' => UserController::class,
            'categories' => CategoryController::class,
            'posts' => PostController::class,
        ]);

        // soft delete
    Route::get('users/restore/{user}', [UserController::class, 'restore'])->name('users.restore');
    Route::delete('users/erase/{user}', [UserController::class, 'erase'])->name('users.erase');

    Route::get('categories/restore/{category}', [categoryController::class, 'restore'])->name('categories.restore');
    Route::delete('categories/erase/{category}', [categoryController::class, 'erase'])->name('categories.erase');

    Route::get('posts/restore/{post}', [PostController::class, 'restore'])->name('posts.restore');
    Route::delete('posts/erase/{post}', [PostController::class, 'erase'])->name('posts.erase');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
