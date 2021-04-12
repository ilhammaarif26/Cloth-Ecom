<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Front\IndexController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('/admin')->namespace('Admin')->group(function () {
    // for login
    Route::match(['get', 'post'], '/', [AdminController::class, 'login']);
    Route::group(['middleware' => ['admin']], function () {
        Route::get('dashboard', [AdminController::class, 'dashboard']);
        Route::get('settings', [AdminController::class, 'settings']);
        Route::get('logout', [AdminController::class, 'logout']);
        Route::post('check-current-pwd', [AdminController::class, 'checkCurrentPwd']);
        // route for change password
        Route::post('update-current-pwd', [AdminController::class, 'updateCurrentPwd']);
        // route for admin details 
        Route::match(['get', 'post'], 'update-admin-details', [AdminController::class, 'updateAdminDetails']);

        // sections
        Route::get('sections', [SectionController::class, 'sections']);
        Route::post('update-section-status', [SectionController::class, 'updateSectionStatus']);
        Route::match(['get', 'post'], 'add-edit-section/{id?}', [SectionController::class, 'addEditSection']);
        Route::get('delete-section/{id}', [SectionController::class, 'deleteSection']);
        Route::get('delete-section-image/{id}', [SectionController::class, 'deleteSectionImage']);

        // brand 
        Route::get('brands', [BrandController::class, 'brands']);
        // add edit brand
        Route::match(['get', 'post'], 'add-edit-brand/{id?}', [BrandController::class, 'addEditBrand']);
        // update brand status
        Route::post('update-brand-status', [BrandController::class, 'updateBrandStatus']);
        // delete brand
        Route::get('delete-brand/{id?}', [BrandController::class, 'deleteBrand']);

        // categories
        Route::get('categories', [CategoryController::class, 'categories']);
        // update category status
        Route::post('update-category-status', [CategoryController::class, 'updateCategoryStatus']);
        // add and edit category 
        Route::match(['get', 'post'], 'add-edit-category/{id?}',  [CategoryController::class, 'addEditCategory']);
        // append category level
        Route::post('append-categories-level', [CategoryController::class, 'appendCategoryLevel']);
        // delete category imgae 
        Route::get('delete-category-image/{id}', [CategoryController::class, 'deleteCategoryImage']);
        // delete category
        Route::get('delete-category/{id}', [CategoryController::class, 'deleteCategory']);

        // products 
        Route::get('products', [ProductsController::class, 'products']);
        // update product status
        Route::post('update-product-status', [ProductsController::class, 'updateProductStatus']);
        // delete product
        Route::get('delete-product/{id}', [ProductsController::class, 'deleteProduct']);
        // add and edit product
        Route::match(['get', 'post'], 'add-edit-product/{id?}', [ProductsController::class, 'addEditProduct']);
        // delete product image
        Route::get('delete-product-image/{id}', [ProductsController::class, 'deleteProductImage']);
        // delete product video
        Route::get('delete-product-video/{id}', [ProductsController::class, 'deleteProductVideo']);

        // add attribute
        Route::match(['get', 'post'], 'add-attributes/{id}', [ProductsController::class, 'addAttributes']);
        // edite attribute 
        Route::post('edit-attributes/{id}', [ProductsController::class, 'editAttributes']);
        // update attribute status
        Route::post('update-attribute-status', [ProductsController::class, 'updateAttributeStatus']);
        // delete attribute 
        Route::get('delete-attribute/{id}', [ProductsController::class, 'deleteAttribute']);

        // add product image for display
        Route::match(['get', 'post'], 'add-images/{id}', [ProductsController::class, 'addImages']);
        // update product images status
        Route::post('update-image-status', [ProductsController::class, 'updateImageStatus']);
        // delete product images
        Route::get('delete-image/{id}', [ProductsController::class, 'deleteImage']);

        // banner
        Route::get('banner', [BannerController::class, 'banner']);
        Route::match(['get', 'post'], 'add-edit-banner/{id?}', [BannerController::class, 'addEditBanner']);
        Route::post('update-banner-status', [BannerController::class, 'updateBannerStatus']);
        Route::get('delete-banner/{id}', [BannerController::class, 'deleteBanner']);
        Route::get('delete-banner-image/{id}', [BannerController::class, 'deleteBannerImage']);
    });
});

Route::namespace('Front')->group(function () {
    Route::get('/', [IndexController::class, 'index']);
});