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
    public function index(Explorer $explorer)
    {
        return CollectibleItem::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Explorer $explorer)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }


}
