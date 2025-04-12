<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Site\ProductController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('site')->group(function () {
        Route::get('/products/index', [ProductController::class, 'index'])->name('productIndex');
        Route::get('/products/product/{id}', [ProductController::class, 'product'])->name('product');
    });
});


/* Admin Panel */
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['auth', 'verified'])->name('dashboard');
        Route::get('/category', [CategoryController::class, 'index'])->name('categoryIndex');
        Route::get('/category/create', [CategoryController::class, 'create'])->name('categoryCreate');
        Route::post('/category/store', [CategoryController::class, 'store'])->name('categoryStore');
        Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('categoryEdit');
        Route::patch('/category/update/{id}', [CategoryController::class, 'update'])->name('categoryUpdate');
        Route::delete('/category/delete/{id}', [CategoryController::class, 'delete'])->name('categoryDelete');

        Route::get('/subcategory/{category_id}', [SubcategoryController::class, 'index'])->name('subcategoryIndex');
        Route::get('/subcategory/create/{category_id}', [SubcategoryController::class, 'create'])->name('subcategoryCreate');
        Route::post('/subcategory/store', [SubcategoryController::class, 'store'])->name('subcategoryStore');
        Route::get('/subcategory/edit/{category_id}/{id}', [SubcategoryController::class, 'edit'])->name('subcategoryEdit');
        Route::patch('/subcategory/update/{id}', [SubcategoryController::class, 'update'])->name('subcategoryUpdate');
        Route::delete('/subcategory/delete/{id}', [SubcategoryController::class, 'delete'])->name('subcategoryDelete');

        Route::get('/products/index', [AdminProductController::class, 'index'])->name('adminProductIndex');
        Route::get('/products/create', [AdminProductController::class, 'create'])->name('adminProductCreate');
        Route::post('/products/store', [AdminProductController::class, 'store'])->name('adminProductStore');
        Route::get('/products/edit/{id}', [AdminProductController::class, 'edit'])->name('adminProductEdit');
        Route::patch('/products/update/{id}', [AdminProductController::class, 'update'])->name('adminProductUpdate');
        Route::delete('/products/delete/{id}', [AdminProductController::class, 'delete'])->name('adminProductDelete');
        Route::get('/products/product/{id}', [AdminProductController::class, 'product'])->name('adminProduct');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
