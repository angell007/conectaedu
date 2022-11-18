<?php

use App\Http\Controllers\InventoryController;
use Illuminate\Support\Facades\Route;

Route::post("register/{store}", [InventoryController::class, "register"]);
Route::get("last/{store}", [InventoryController::class, "last"]);
Route::post("update/{inventory}", [InventoryController::class, "update"]);
Route::get("lastest", [InventoryController::class, "reportAllStores"]);
Route::get("stores", [InventoryController::class, "stores"]);
Route::get("get_element/{element}", [InventoryController::class, "getElement"]);
// Route::get("unreaded", [InventoryController::class, "unreaded"]);
Route::get("unreaded",  function ()
{
    $output = shell_exec('pdftohtml -layout create.pdf updated.html');

});

// Route::get("{element}", [InventoryController::class, "get"]);
// Route::get("saveinventory/{store}", [InventoryController::class, "saveinventory"]);
