<?php

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


use App\Http\Controllers\PeopleController;
use App\Http\Controllers\ImportController;

Route::post('/import', [ImportController::class, 'import']);

Route::post('/import-people', [PeopleController::class, 'importExcel']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
