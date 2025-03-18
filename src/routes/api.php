<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CollectibleItemController;
use App\Http\Controllers\ExplorerController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\TradeController;
use App\Http\Controllers\UserController;
use App\Models\CollectibleItem;
use App\Models\Explorer;
use App\Models\Inventory;
use App\Models\Trade;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);


Route::apiResource('explorers', UserController::class)->except(['destroy', 'store']);

Route::post('explorers/{explorer}/collectible-items', [CollectibleItemController::class, 'store']);
Route::get('explorers/{explorer}/history', [LocationController::class, 'index']);
Route::get('collectible-items', [CollectibleItemController::class, 'index']);
Route::post('explorers/trade', [TradeController::class, 'trade']);
