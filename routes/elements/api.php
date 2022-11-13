<?php

use App\Http\Controllers\ElementController;
use Illuminate\Support\Facades\Route;

Route::post("register", [ElementController::class, "register"]);
Route::post("update/{element}", [ElementController::class, "update"]);
Route::get("index/{store}", [ElementController::class, "index"]);
Route::get("{element}", [ElementController::class, "get"]);
