<?php

namespace App\Http\Controllers;

use App\Models\CollectibleItem;
use App\Models\Explorer;
use App\Models\Inventory;
use App\Models\Trade;
use App\Models\TradeItem;
use Exception;
use Illuminate\Http\Request;

class TradeController extends Controller
{
  public function trade(Request $request){
    try{
        $trade = Trade::create([
            ...$request->validate([
              'explorer_to_id' => 'required|exists:explorers,id',
              'explorer_for_id' => 'required|exists:explorers,id'
            ]),
            'status' => 'pending'
          ]);

        $explorerTo = Explorer::findOrFail($trade->explorer_to_id);
        $explorerFor = Explorer::findOrFail($trade->explorer_for_id);

        foreach($request->items as $item){
            if($item['explorer_id'] != $explorerTo->id && $item['explorer_id'] != $explorerFor->id){
                $trade->update(['status' => 'failed']);
                throw new Exception('trade failed! Item not belong any explorer!');
            }

            if(($explorerTo->inventory()->where('collectible_item_id', $item['collectible_item_id'])->exists() && $item['explorer_id'] == $explorerFor->id) || ($explorerFor->inventory()->where('collectible_item_id', $item['collectible_item_id'])->exists() && $item['explorer_id'] == $explorerTo->id)){
                throw new Exception('trade failed! Item already in inventory!');
            }

            $explorer = ($item['explorer_id'] == $explorerTo->id) ? $explorerTo : $explorerFor;
            $hasItem = $explorer->inventory()->where('collectible_item_id', $item['collectible_item_id'])->exists();

            if(!$hasItem){
                throw new Exception('Trade failed! Item not in inventory an explorer!');
            }

            $tradeItem = TradeItem::create([
              'trade_id' => $trade->id,
              'collectible_item_id' => $item['collectible_item_id'],
              'explorer_id' => $item['explorer_id']
            ]);
        }

        $todos = TradeItem::where('trade_id', $trade->id)->get();
        $itemsExplorerTo = $todos->where('explorer_id', $explorerTo->id);
        $itemsExplorerFor = $todos->where('explorer_id', $explorerFor->id);

        $itemsExplorerTo = CollectibleItem::whereIn('id', $itemsExplorerTo->pluck('collectible_item_id'))->get();
        $itemsExplorerFor = CollectibleItem::whereIn('id', $itemsExplorerFor->pluck('collectible_item_id'))->get();


        if($this->valueTrade($itemsExplorerTo) == $this->valueTrade($itemsExplorerFor)){
            foreach($itemsExplorerTo as $item){
                $explorerTo->inventory()->where('collectible_item_id', $item->id)->delete();
            }
            foreach($itemsExplorerFor as $item){
                $explorerFor->inventory()->where('collectible_item_id', $item->id)->delete();
            }

            foreach($itemsExplorerTo as $item){
                $explorerFor->inventory()->create([
                    'explorer_id' => $explorerFor->id,
                    'collectible_item_id' => $item->id
                ]);
            }
            foreach($itemsExplorerFor as $item){
                $explorerTo->inventory()->create([
                    'explorer_id' => $explorerTo->id,
                    'collectible_item_id' => $item->id
                ]);
            }

          $trade->update(
            ['status' => 'completed']
          );
          return response()->json([
            'message' => 'trade completed successfully!',
            'status' => 201
          ]);
        } else {
          throw new Exception('trade failed! Items not equal value!');
        }


    } catch (Exception $e) {
        $trade->update(['status' => 'failed']);
      return response()->json([
        'message' => $e->getMessage(),
        'status' => 400
      ]);
    }
    }

  public function valueTrade($items){
    $valueTotal = 0;
    foreach($items as $item){
        $valueTotal += $item->price;
    }

    return intval($valueTotal);
  }
}
