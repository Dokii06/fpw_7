<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'RoleCheck:admin'])->name('dashboard');

Route::middleware('auth', 'verified', 'RoleChechk:admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

    Route::get('/product', [ProductController::class, 'index'])->name("product-index");
    Route::get('/product/create', [ProductController::class, 'create'])->name("product-create");
    Route::post('/product', [ProductController::class, 'store'])->name("product-store");
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name("product-edit");
    Route::put('/products/{id}', [ProductController::class, 'update'])->name("product-update");
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name("product-delete");

require __DIR__.'/auth.php';
