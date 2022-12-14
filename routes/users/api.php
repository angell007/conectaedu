<?php

use App\Http\Controllers\InventoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post("register", [UserController::class, 'register'])->name('register');
Route::get("index", [UserController::class, 'index'])->name('index');
Route::get("myowners/{id}", [InventoryController::class, "myowners"]);
