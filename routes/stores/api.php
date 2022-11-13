<?php

use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;

Route::post("register", [StoreController::class, "register"]);
Route::post("update/{store}", [StoreController::class, "update"]);
Route::get("index", [StoreController::class, "index"]);
Route::get("{store}", [StoreController::class, "get"]);
