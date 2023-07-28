<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[AuthController::class,'index']);
Route::get('forgot-password',[AuthController::class,'forgot_password']);
Route::get ('register',[AuthController::class,'register']);
Route::post('register_post',[AuthController::class,'register_post']);
Route::post('checkemail',[AuthController::class,'Checkemail']);
Route::post('login_post',[AuthController::class,'login_post']);


// Admin || HR Same Name 

Route::group(['middleware'=> 'admin'],function(){
    Route::get('admin/dashboard',[DashboardController::class,'dashboard']);
});