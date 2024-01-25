<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentApiController;
use App\Http\Controllers\MemberApiController;

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
Route::post('member', [StudentApiController::class, 'store']);
Route::get('member', [StudentApiController::class, 'index']);
Route::post('member/{id}', [StudentApiController::class, 'update']);
Route::delete('member/{id}', [StudentApiController::class,'destroy']);

