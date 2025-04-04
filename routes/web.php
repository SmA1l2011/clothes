<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Site\ProductController;
use App\Http\Controllers\Site\CategoryController;
use App\Http\Controllers\Site\SubcategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/products', [ProductController::class, 'catalog'])->name('catalog');


/* Admin Panel */
Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/category', [CategoryController::class, 'getAllCategories'])->name('categoryIndex');
        Route::get('/category/create', [CategoryController::class, 'categoryCreate'])->name('categoryCreate');
        Route::post('/category/store', [CategoryController::class, 'categoryStore'])->name('categoryStore');
        Route::get('/category/edit/{id}', [CategoryController::class, 'categoryEdit'])->name('categoryEdit');
        Route::patch('/category/update/{id}', [CategoryController::class, 'categoryUpdate'])->name('categoryUpdate');
        Route::delete('/category/delete/{id}', [CategoryController::class, 'categoryDelete'])->name('categoryDelete');

        Route::get('/subcategory/{category_id}', [SubcategoryController::class, 'index'])->name('subcategoryIndex');
        Route::get('/subcategory/create/{category_id}', [SubcategoryController::class, 'subcategoryCreate'])->name('subcategoryCreate');
        Route::post('/subcategory/store', [SubcategoryController::class, 'subcategoryStore'])->name('subcategoryStore');
        Route::get('/subcategory/edit/{category_id}/{id}', [SubcategoryController::class, 'subcategoryEdit'])->name('subcategoryEdit');
        Route::patch('/subcategory/update/{id}', [SubcategoryController::class, 'subcategoryUpdate'])->name('subcategoryUpdate');
        Route::delete('/subcategory/delete/{id}', [SubcategoryController::class, 'subcategoryDelete'])->name('subcategoryDelete');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
