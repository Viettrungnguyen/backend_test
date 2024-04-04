<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\FolderComparisonController;
use App\Http\Controllers\SerialPasoController;
use App\Http\Controllers\FileCopyController;
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
// test 1
Route::post('/accounts', [AccountController::class, 'store']);
Route::post('/accounts/{id}', [AccountController::class, 'update']);
Route::delete('/accounts', [AccountController::class, 'destroy']);
Route::get('/accounts/{id}', [AccountController::class, 'show']);
Route::get('/accounts', [AccountController::class, 'index']);

// test 2
Route::post('/showSerialpaso', [SerialPasoController::class, 'show']);

// test 3
Route::post('/compare-folders', [FolderComparisonController::class, 'compareFolders']);

// Create file for test
Route::get('/copy-file', [FileCopyController::class, 'copyFile']);
