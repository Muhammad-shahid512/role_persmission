<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesController;
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

    Route::get('/permission', [PermissionController::class, 'index'])->name('permissions');
    Route::get('/permission/create', [PermissionController::class, 'create'])->name('permission.create');
    Route::get('/permission/store', [PermissionController::class, 'store'])->name('permission.store');



     Route::get('roles', [RolesController::class, 'index'])->name('roles');
     Route::get('roles/create', [RolesController::class, 'create'])->name('roles.create');
     Route::post('roles/store', [RolesController::class, 'store'])->name('roles.store');
    Route::get('roles/update/{id}', [RolesController::class, 'edit'])->name('role.edit');
    Route::post('roles/update/post/{id}', [RolesController::class, 'update'])->name('role.edit.post');
    Route::get('roles/delete/{id}', [RolesController::class, 'destroy'])->name('role.delete');



         Route::get('articles', [ArticleController::class, 'index'])->name('articles');
         Route::get('article/create', [ArticleController::class, 'create'])->name('article.create');
         Route::post('article/post', [ArticleController::class, 'store'])->name('article.post');
         Route::get('article/update/{id}', [ArticleController::class, 'edit'])->name('article.edit');
         Route::post('article/update/post/{id}', [ArticleController::class, 'update'])->name('article.update');
         Route::get('article/delete/{id}', [ArticleController::class, 'delete'])->name('article.delete');


});

require __DIR__.'/auth.php';
