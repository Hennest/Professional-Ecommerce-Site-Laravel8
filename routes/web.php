<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Http\Controllers\PasswordResetLinkController;
use App\Http\Controllers\NewPasswordController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SubSubCategoryController;
use App\Http\Controllers\Backend\ProductController;


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
    return view('frontend.index');
});

Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function(){
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});


//.........All Frontend Route..........//
Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('/user/update/profile', [UserProfileController::class, 'UpdateProfile'])->name('user.update.profile');
Route::post('/user/store/profile', [UserProfileController::class, 'StoreProfile'])->name('user.store.profile');
Route::get('/user/photo/remove', [UserProfileController::class, 'ProfilePhotoRemove'])->name('user.photo.remove');
Route::get('/user/update/password', [UserProfileController::class, 'PasswordUpdate'])->name('user.update.password');
Route::post('/user/change/password', [UserProfileController::class, 'PasswordChange'])->name('user.change.password');

//--------------------------------------------------------------------------------------------------------------//

//.........All Admin Route..........//
Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('dashboard');


Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
Route::get('/admin/profile', [AdminProfileController::class, 'AdminProfile'])->name('admin.profile');
Route::post('/admin/profile/update', [AdminProfileController::class, 'AdminProfileUpdate'])->name('admin.profile.update');
Route::get('/admin/photo/remove', [AdminProfileController::class, 'ProfilePhotoRemove'])->name('admin.photo.remove');
Route::get('/admin/change/password', [AdminProfileController::class, 'PasswordChange'])->name('admin.change.password');
Route::post('/admin/update/password', [AdminProfileController::class, 'PasswordUpdate'])->name('admin.update.password');

//...........Admin Brand Route........//
Route::prefix('brand')->group(function(){
    Route::get('/view', [BrandController::class, 'BrandView'])->name('all.brand');
    Route::post('/add', [BrandController::class, 'BrandAdd'])->name('store.brand');
    Route::get('/edit/{id}', [BrandController::class, 'BrandEdit'])->name('edit.brand');
    Route::post('/update/{id}', [BrandController::class, 'BrandUpdate'])->name('update.brand');
    Route::get('/delete/{id}', [BrandController::class, 'BrandDelete'])->name('delete.brand');
});

//...........Admin Category Route........//
Route::prefix('category')->group(function(){
    Route::get('/view', [CategoryController::class, 'CategoryView'])->name('all.category');
    Route::post('/add', [CategoryController::class, 'CategoryAdd'])->name('store.category');
    Route::get('/edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('edit.category');
    Route::post('/update/{id}', [CategoryController::class, 'CategoryUpdate'])->name('update.category');
    Route::get('/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('delete.category');

    //.......Sub Category Route........//
    Route::get('/sub/view', [SubCategoryController::class, 'SubCategoryView'])->name('all.sub_category');
    Route::post('/sub/add', [SubCategoryController::class, 'SubCategoryAdd'])->name('store.sub_category');
    Route::get('/sub/edit/{id}', [SubCategoryController::class, 'SubCategoryEdit'])->name('edit.sub_category');
    Route::post('/sub/update/{id}', [SubCategoryController::class, 'SubCategoryUpdate'])->name('update.sub_category');
    Route::get('/sub/delete/{id}', [SubCategoryController::class, 'SubCategoryDelete'])->name('delete.sub_category');

    //.......Sub-Sub Category Route........//
    Route::get('/sub/sub/view', [SubSubCategoryController::class, 'View'])->name('all.sub_sub_category');
    Route::post('/sub/sub/add', [SubSubCategoryController::class, 'Add'])->name('store.sub_sub_category');
    Route::get('/subcategory/ajax/{category_id}', [SubSubCategoryController::class, 'GetSubCategory']);
    Route::get('/sub/sub/edit/{id}', [SubSubCategoryController::class, 'Edit'])->name('edit.sub_sub_category');
    Route::post('/sub/sub/update/{id}', [SubSubCategoryController::class, 'Update'])->name('update.sub_sub_category');
    Route::get('/sub/sub/delete/{id}', [SubSubCategoryController::class, 'Delete'])->name('delete.sub_sub_category');
});

//.........Admin Product Route...........//
Route::prefix('product')->group(function(){
    Route::get('/add', [ProductController::class, 'ProductAdd'])->name('add.product');
    Route::get('/subcategory/ajax/{category_id}', [ProductController::class, 'GetSubCategory']);
    Route::get('/sub_subcategory/ajax/{sub_category_id}', [ProductController::class, 'GetSubSubCategory']);
    Route::post('/store', [ProductController::class, 'ProductStore'])->name('store.product');
});
