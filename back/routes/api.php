<?php

use App\Http\Controllers\ProduitController;
use App\Http\Controllers\SuccursaleController;
use App\Http\Controllers\UserControlle;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user',[UserControlle::class,'user']);
});
Route::post('succursale',[SuccursaleController::class,"store"]);
Route::get('succursale',[SuccursaleController::class,"index"]);
Route::put('succursale/{id}',[SuccursaleController::class,"update"]);
Route::delete('succursale/{id}',[SuccursaleController::class,"destroy"]);


Route::post('user',[UserControlle::class,"store"]);
Route::get('user',[UserControlle::class,"index"]);
Route::get('userCherche/{id}',[UserControlle::class,'show']);
Route::put('user/{id}',[UserControlle::class,"update"]);
Route::delete('user/{id}',[UserControlle::class,"destroy"]);
Route::post('loginUser',[UserControlle::class,'loginUser']);
Route::get('deconnecte/{id}',[UserControlle::class,'logout']);


Route::post('produit',[ProduitController::class,'store']);
Route::get('produit',[ProduitController::class,'index']);
Route::get('produit/{id}',[ProduitController::class,'show']);
Route::put('produit/{id}',[ProduitController::class,'update']);
Route::delete('produit/{id}',[ProduitController::class,'destroy']);

