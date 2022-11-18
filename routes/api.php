<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;


Route::prefix("auth")->group(
  function () {
    Route::post("login", [AuthController::class, 'login'])->name('login');
    Route::post("register", [AuthController::class, "register"]);
    Route::middleware("auth.jwt")->group(function () {
      Route::post("logout", [AuthController::class, "logout"]);
      Route::post("refresh", [AuthController::class, "refresh"]);
      Route::post("me", [AuthController::class, "me"]);
      Route::get("renew", [AuthController::class, "renew"]);
      Route::get("change-password", [
        AuthController::class,
        "changePassword",
      ]);
    });
  }
);


Route::get('qr-code-g', function () {

  // $image = \QrCode::backgroundColor(255, 255, 0)->color(255, 0, 127)
  //   ->format('png')
  //   // ->merge(public_path('/imgs/inventory.png'), 0.3, true)
  //   ->size(500)
  //   ->generate('ItSolutionStuff.com',  public_path('/imgs/' . '123.png'));
  // return response($image)->header('Content-type', 'image/png');
});
