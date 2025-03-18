<?php

namespace App\Http\Controllers;

use App\Models\CollectibleItem;
use App\Models\Explorer;
use App\Models\Inventory;
use App\Models\Trade;
use App\Models\TradeItem;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class TradeController extends Controller
{
  public function trade(Request $request){
    try{
        $trade = Trade::create([
            ...$request->validate([
              'user_to_id' => 'required|exists:users,id',
              'user_for_id' => 'required|exists:users,id'
            ]),
            'status' => 'pending'
          ]);

        $userTo = User::findOrFail($trade->user_to_id);
        $userFor = User::findOrFail($trade->user_for_id);

        foreach($request->items as $item){
            $collectibleItem = CollectibleItem::findOrFail($item['collectible_item_id']);

            if($collectibleItem->user_id != $userTo->id && $collectibleItem->user_id != $userFor->id){
                throw new Exception('trade failed! Collectible item not belong any explorer!');
            }

            if($collectibleItem->user_id != $item['user_id']){
                throw new Exception('trade failed! Collectible item not belong to explorer!');
            }


            $tradeItem = TradeItem::create([
              'trade_id' => $trade->id,
              'collectible_item_id' => $item['collectible_item_id'],
              'user_id' => $item['user_id']
            ]);
        }

        $todos = TradeItem::where('trade_id', $trade->id)->get();
        $itemsUserTo = $todos->where('user_id', $userTo->id);
        $itemsUserFor = $todos->where('user_id', $userFor->id);

        $itemsUserTo = CollectibleItem::whereIn('id', $itemsUserTo->pluck('collectible_item_id'))->get();
        $itemsUserFor = CollectibleItem::whereIn('id', $itemsUserFor->pluck('collectible_item_id'))->get();


        if($this->valueTrade($itemsUserTo) == $this->valueTrade($itemsUserFor)){
           foreach($itemsUserTo as $item){
            $item->update(['user_id' => $userFor->id]);
          }

          foreach($itemsUserFor as $item){
            $item->update(['user_id' => $userTo->id]);
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
