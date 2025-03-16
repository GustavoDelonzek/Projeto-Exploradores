<?php

use App\Http\Controllers\CollectibleItemController;
use App\Http\Controllers\ExplorerController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\TradeController;
use App\Models\CollectibleItem;
use App\Models\Explorer;
use App\Models\Inventory;
use App\Models\Trade;
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

Route::apiResource('explorers', ExplorerController::class)->except(['destroy']);
Route::apiResource('explorers.collectible-items', CollectibleItemController::class)->scoped()->except(['destroy', 'update', 'show', 'index']);
Route::post('explorers/trade', [TradeController::class, 'trade']);
