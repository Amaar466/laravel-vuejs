<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\BookingController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Routes for Users
Route::post('/register' ,[UserController::class,'store'])->name('register.user');
Route::post('/login' , [UserController::class,'login']);
Route::post('/logout' , [UserController::class,'destroy']);
//Route for Add restaurant data


Route::post('/add-restaurant', [RestaurantController::class, 'store']);

//route for Add team mamber
Route::post('/add-team',[TeamController::class,'store']);
Route::get('/fetch_team', [TeamController::class, 'index']);
Route::put('/teammembers/{id}', [TeamController::class, 'update']);

Route::post('/book-table', [BookingController::class, 'bookTable']);


