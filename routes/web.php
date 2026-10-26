<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ShoppingListController;
use App\Http\Controllers\ShoppingListItemController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // Registration
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    // login
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/shopping-lists', [ShoppingListController::class, 'index'])->name('shopping-lists.index');
    Route::post('/shopping-lists', [ShoppingListController::class, 'store'])->name('shopping-lists.store');
    Route::get('/shopping-lists/{shoppingList}', [ShoppingListController::class, 'show'])->name('shopping-lists.show');
    Route::get('/shopping-lists/{shoppingList}/items/create', [ShoppingListItemController::class, 'create'])->name('shopping-lists.items.create');
    Route::post('/shopping-lists/{shoppingList}/items', [ShoppingListItemController::class, 'store'])->name('shopping-lists.items.store');
    Route::patch('/shopping-lists/{shoppingList}/items/reorder', [ShoppingListItemController::class, 'reorder'])->name('shopping-lists.items.reorder');
    Route::delete('/shopping-lists/{shoppingList}/items/{item}', [ShoppingListItemController::class, 'destroy'])->name('shopping-lists.items.destroy');
    Route::patch('/shopping-lists/{shoppingList}/items/{item}/purchased', [ShoppingListItemController::class, 'updatePurchasedStatus'])->name('shopping-lists.items.purchased');
    
    Route::post('/shopping-lists/{shoppingList}/share', [ShoppingListController::class, 'share'])->name('shopping-lists.share');

    // Logout
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
});


Route::get('/', function () {
    return redirect()->route('shopping-lists.index');
})->name('home');
