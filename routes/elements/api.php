<?php

use App\Http\Controllers\ElementController;
use Illuminate\Support\Facades\Route;

Route::post("register", [ElementController::class, "register"]);
Route::post("update/{element}", [ElementController::class, "update"]);
Route::get("index", [ElementController::class, "index"]);
// Route::get("index/{store}", [ElementController::class, "index"]);
Route::get("saveinventory/{store}", [ElementController::class, "saveinventory"]);
Route::get("getqr/{element}", [ElementController::class, "getQr"]);
Route::get("pdfdownload/{id}", [ElementController::class, "downloadPdf"]);
Route::get("changuestatus", [ElementController::class, "changuestatus"]);
Route::get("{element}", [ElementController::class, "get"]);
