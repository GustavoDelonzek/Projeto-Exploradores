<?php

namespace App\Http\Controllers;

use App\Models\CollectibleItem;
use App\Models\Explorer;
use App\Models\Inventory;
use Illuminate\Http\Request;

class CollectibleItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(){
        return CollectibleItem::all();
    }

    public function store(Request $request, Explorer $explorer)
    {

        $post = CollectibleItem::create([
            ...$request->validate([
                'name' => 'required|string|max:80',
                'price' => 'required',
                'latitude' => 'required|string',
                'longitude' => 'required|string'
            ]),
            'explorer_id' => $explorer->id
        ]);


        return $post;
    }


}
