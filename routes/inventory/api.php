<?php

use App\Http\Controllers\InventoryController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
// use Gufy\PdfToHtml\Config;

Route::post("register/{store}", [InventoryController::class, "register"]);
Route::post("edit/{inventory}", [InventoryController::class, "update"]);
Route::get("last/{store}", [InventoryController::class, "last"]);
Route::post("update/{inventory}", [InventoryController::class, "update"]);
Route::get("lastest", [InventoryController::class, "reportAllStores"]);
Route::get("stores", [InventoryController::class, "stores"]);
Route::get("get_element/{element}", [InventoryController::class, "getElement"]);
Route::get("unreaded", [InventoryController::class, "unreaded"]);
Route::get("owners/{id}", [InventoryController::class, "owners"]);

// Route::get("unreaded",  function () {

//         $phpWord = \PhpOffice\PhpWord\IOFactory::load(public_path('file2.docx'));
//         $section = $phpWord->addSection();

//         $source = public_path() . "/xxx.html";

       
//         $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
//         $objWriter->save($source);

//        return response()->json('listo');
      
// });
// Route::get("{element}", [InventoryController::class, "get"]);
// Route::get("saveinventory/{store}", [InventoryController::class, "saveinventory"]);
