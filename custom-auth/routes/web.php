<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/registeration', [CustomAuthController::class,"registeration"])->middleware("alreadyLogin"); 
Route::get('/login', [CustomAuthController::class,"login"])->name("login")->middleware("alreadyLogin"); 

Route::post('/customregister', [CustomAuthController::class,"customRegister"])->name("customregister");
Route::post('/customlogin', [CustomAuthController::class,"customLogin"])->name("customlogin");

Route::middleware(['IfNotLogin'])->group(function () {
    Route::get('/dashboard', [CustomAuthController::class,"dashboard"])->name("dashboard");
    Route::get('/orders', [CustomAuthController::class,"orders"])->name("orders");
    Route::get('/customers', [CustomAuthController::class,"customers"])->name("customers");
    Route::get('/reports', [CustomAuthController::class,"reports"])->name("reports");
 });

Route::get('/forgetPassword', [CustomAuthController::class,"forgetPassword"])->name("forgetPassword");
Route::post('/custom_forget_password', [CustomAuthController::class,"customForgetPassword"])->name("custom_forget_password");
Route::get('/verify_link/{link}/{email}', [CustomAuthController::class,"verifyLink"])->name("verify_link");
Route::post('/update_password', [CustomAuthController::class,"updatePassword"])->name("update_password");

Route::get('/logout', [CustomAuthController::class,"logout"])->name("logout");