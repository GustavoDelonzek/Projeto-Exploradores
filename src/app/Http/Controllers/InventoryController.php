<?php

namespace App\Http\Controllers;

use App\Models\CollectibleItem;
use App\Models\Explorer;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Explorer $explorer)
    {
        return $explorer->inventory->collectibleItem;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Explorer $explorer)
    {
        $post = CollectibleItem::create([
            ...$request->validate([
                'name' => 'required|string|max:80',
                'price' => 'required',
                'latitude' => 'required|string',
                'longitude' => 'required|string'
            ]),
            'inventory_id' => $explorer->inventory->id
        ]);

        return $post;

    }

}
