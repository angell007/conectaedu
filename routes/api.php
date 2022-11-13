<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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
  
  