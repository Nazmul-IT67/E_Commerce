<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;

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

/**-----Backend Category Routes----**/
Route::get('category-add', [CategoryController::class, 'AddCategory'])->name('AddCategory');
Route::POST('category-post', [CategoryController::class, 'CategoryPost'])->name('CategoryPost');
Route::get('category-list', [CategoryController::class, 'CategoryList'])->name('CategoryList');
Route::get('category-edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('CategoryEdit');
Route::get('category-delete/{id}', [CategoryController::class, 'CategoryTrash'])->name('CategoryTrash');
Route::get('trash-list', [CategoryController::class, 'TrashList'])->name('TrashList');
Route::POST('category-update', [CategoryController::class, 'CategoryUpdate'])->name('CategoryUpdate');
Route::get('category-reset/{id}', [CategoryController::class, 'CategoryReset'])->name('CategoryReset');
Route::get('category-sofd/{id}', [CategoryController::class, 'CategorySofd'])->name('CategorySofd');

/**-----Backend Sub Category Routes----**/
Route::get('subcategory-add', [SubCategoryController::class, 'SubCategoryAdd'])->name('SubCategoryAdd');
Route::POST('subcategory-post', [SubCategoryController::class, 'SubCategoryPost'])->name('SubCategoryPost');
Route::get('subcategory-list', [SubCategoryController::class, 'SubCategoryList'])->name('SubCategoryList');
Route::get('trash-scategory', [SubCategoryController::class, 'TrashSubCategory'])->name('TrashSubCategory');
Route::get('subcategory-edit/{id}', [SubCategoryController::class, 'SubCategoryEdit'])->name('SubCategoryEdit');
Route::POST('subcategory-update', [SubCategoryController::class, 'SubCategoryUpdate'])->name('SubCategoryUpdate');
Route::get('subcategory-delete/{id}', [SubCategoryController::class, 'SubCategoryDelete'])->name('SubCategoryDelete');
Route::get('subcategory-reset/{id}', [SubCategoryController::class, 'SubCategoryReset'])->name('SubCategoryReset');
Route::get('subcategory-sofd/{id}', [SubCategoryController::class, 'SubCategorySofd'])->name('SubCategorySofd');
