<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});
require __DIR__.'/auth.php';

/**********Dashboard Routes*************/
Route::get('dashboard', [DashboardController::class, 'Dashboard'])->name('Dashboard');

/**-----Backend Routes----**/
Route::get('category-add', [CategoryController::class, 'AddCategory'])->name('AddCategory');
Route::POST('category-post', [CategoryController::class, 'CategoryPost'])->name('CategoryPost');
Route::get('category-list', [CategoryController::class, 'CategoryList'])->name('CategoryList');
Route::get('category-edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('CategoryEdit');
Route::get('category-delete/{id}', [CategoryController::class, 'CategoryTrash'])->name('CategoryTrash');
Route::get('trash-list', [CategoryController::class, 'TrashList'])->name('TrashList');
Route::POST('category-update', [CategoryController::class, 'CategoryUpdate'])->name('CategoryUpdate');
Route::get('category-reset/{id}', [CategoryController::class, 'CategoryReset'])->name('CategoryReset');
Route::get('category-sofd/{id}', [CategoryController::class, 'CategorySofd'])->name('CategorySofd');
