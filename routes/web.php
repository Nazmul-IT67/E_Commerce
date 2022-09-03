<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CuponController;
use App\Http\Controllers\CheckoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});
require __DIR__.'/auth.php';
/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
*/
Route::get('dashboard', [DashboardController::class, 'Dashboard'])->name('Dashboard');
/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [FrontendController::class, 'Frontend'])->name('Frontend');
Route::get('single/{slug}', [FrontendController::class, 'SingleProduct'])->name('SingleProduct');
Route::get('shop', [FrontendController::class, 'ShopPage'])->name('ShopPage');
/*
|--------------------------------------------------------------------------
| Category Routes
|--------------------------------------------------------------------------
*/
Route::get('category-add', [CategoryController::class, 'AddCategory'])->name('AddCategory');
Route::POST('category-post', [CategoryController::class, 'CategoryPost'])->name('CategoryPost');
Route::get('category-list', [CategoryController::class, 'CategoryList'])->name('CategoryList');
Route::get('category-edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('CategoryEdit');
Route::get('category-delete/{id}', [CategoryController::class, 'CategoryTrash'])->name('CategoryTrash');
Route::get('trash-list', [CategoryController::class, 'TrashList'])->name('TrashList');
Route::POST('category-update', [CategoryController::class, 'CategoryUpdate'])->name('CategoryUpdate');
Route::get('category-reset/{id}', [CategoryController::class, 'CategoryReset'])->name('CategoryReset');
Route::get('category-sofd/{id}', [CategoryController::class, 'CategorySofd'])->name('CategorySofd');
/*
|--------------------------------------------------------------------------
| Sub-Category Routes
|--------------------------------------------------------------------------
*/
Route::get('subcategory-add', [SubCategoryController::class, 'SubCategoryAdd'])->name('SubCategoryAdd');
Route::POST('subcategory-post', [SubCategoryController::class, 'SubCategoryPost'])->name('SubCategoryPost');
Route::get('subcategory-list', [SubCategoryController::class, 'SubCategoryList'])->name('SubCategoryList');
Route::get('trash-scategory', [SubCategoryController::class, 'TrashSubCategory'])->name('TrashSubCategory');
Route::get('subcategory-edit/{id}', [SubCategoryController::class, 'SubCategoryEdit'])->name('SubCategoryEdit');
Route::POST('subcategory-update', [SubCategoryController::class, 'SubCategoryUpdate'])->name('SubCategoryUpdate');
Route::get('subcategory-delete/{id}', [SubCategoryController::class, 'SubCategoryDelete'])->name('SubCategoryDelete');
Route::get('subcategory-reset/{id}', [SubCategoryController::class, 'SubCategoryReset'])->name('SubCategoryReset');
Route::get('subcategory-sofd/{id}', [SubCategoryController::class, 'SubCategorySofd'])->name('SubCategorySofd');
/*
|--------------------------------------------------------------------------
| Products Routes
|--------------------------------------------------------------------------
*/
Route::get('product-add', [ProductController::class, 'ProductAdd'])->name('ProductAdd');
Route::POST('product-post', [ProductController::class, 'ProductPost'])->name('ProductPost');
Route::get('product-list', [ProductController::class, 'ProductList'])->name('ProductList');
Route::get('product-trash', [ProductController::class, 'ProductTrash'])->name('ProductTrash');
Route::get('sub-cat/{id}', [ProductController::class, 'SubCat'])->name('SubCat');
Route::get('product-edit/{id}', [ProductController::class, 'ProductEdit'])->name('ProductEdit');
Route::POST('product-update', [ProductController::class, 'ProductUpdate'])->name('ProductUpdate');
Route::get('product-delete/{id}', [ProductController::class, 'ProductDelete'])->name('ProductDelete');
Route::get('product-restor/{id}', [ProductController::class, 'ProductRestor'])->name('ProductRestor');
Route::get('product-soft/{id}', [ProductController::class, 'ProductSoft'])->name('ProductSoft');
Route::get('brand', [ProductController::class, 'AddBrand'])->name('AddBrand');
Route::get('color', [ProductController::class, 'AddColor'])->name('AddColor');
Route::get('size', [ProductController::class, 'AddSize'])->name('AddSize');
Route::POST('brand', [ProductController::class, 'BrandPost'])->name('BrandPost');
Route::POST('color', [ProductController::class, 'ColorPost'])->name('ColorPost');
Route::POST('size', [ProductController::class, 'SizePost'])->name('SizePost');
/*
|--------------------------------------------------------------------------
| Cart Routes
|--------------------------------------------------------------------------
*/
Route::get('single/cart/{slug}',[CartController::class, 'SingleCart'])->name('SingleCart');
Route::POST('product/cart/',[CartController::class, 'ProductCurt'])->name('ProductCurt');
Route::get('cart-product',[CartController::class, 'CartProduct'])->name('CartProduct');
Route::get('cart-product/{slug}',[CartController::class, 'CartProduct'])->name('CartCupon');
Route::POST('cart-update',[CartController::class, 'CartUpdate'])->name('CartUpdate');
Route::POST('ajaxcartupdate',[CartController::class, 'AjaxCartUpdate'])->name('AjaxCartUpdate');
/*
|--------------------------------------------------------------------------
| Cupon Routes
|--------------------------------------------------------------------------
*/
Route::get('cupon', [CuponController::class, 'Cupon'])->name('Cupon');
Route::post('cupon-post', [CuponController::class, 'CuponPost'])->name('CuponPost');
/*
|--------------------------------------------------------------------------
| Checkout Routes
|--------------------------------------------------------------------------
*/
Route::get('checkout', [CheckoutController::class, 'Checkout'])->name('Checkout');
Route::POST('checkout', [CheckoutController::class, 'CheckoutPost'])->name('CheckoutPost');
