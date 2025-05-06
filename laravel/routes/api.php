<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::controller(CategoryController::class)->prefix('categories')->group(function(){
    Route::get('/', 'getCategories');
    Route::post('/', 'createCategory');
    Route::get('/search', 'searchCategory');
    Route::get('/sort', 'sortCategories');
    Route::get('/limited_category/{limited}', 'getLimitedCategories');
    Route::get('/{categoryId}', 'getCategory');
    Route::patch('/{categoryId}', 'updateCategory');
    Route::delete('/{categoryId}', 'deleteCategory');
    Route::get('/{categoryId}/products', 'getProductsByCategory');
    Route::post('/restore/{categoryId}', 'restoreCategory');

});

Route::controller(ProductController::class)->prefix('products')->group(function(){
    Route::get('/', 'getAll');
    Route::post('/', 'createProducts');
    Route::get('/{productId}','findProductByID');
    Route::delete('/{productId}','deleteProducts');
    Route::patch('/{productId}', "updateProducts");
});



