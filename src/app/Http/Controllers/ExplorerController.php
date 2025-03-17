<?php

namespace App\Http\Controllers;

use App\Models\Explorer;
use App\Models\Inventory;
use App\Models\Location;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class ExplorerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Explorer::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $explorador = Explorer::create([
            ...$request->validate([
                'name' => 'required|string|max:80',
                'age' => 'required|integer|between:0,100',
                'latitude' => 'required|string',
                'longitude' => 'required|string'
            ])]
        );

        $location = Location::create([
            'explorer_id' => $explorador->id,
            'latitude' => $explorador->latitude,
            'longitude' => $explorador->longitude
        ]);


        return response(status: 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Explorer $explorer)
    {

        return response()->json([
            $explorer->load('inventory.collectibleItem')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Explorer $explorer)
    {
        $explorer->update(
            $request->validate([
                'latitude' => 'sometimes|string',
                'longitude' => 'sometimes|string'
            ])
        );

        $location = Location::create([
            'explorer_id' => $explorer->id,
            'latitude' => $explorer->latitude,
            'longitude' => $explorer->longitude
        ]);

        return $explorer;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Explorer $explorer)
    {
        $explorer->delete();

        return response()->json([
            'message' => "deleted explorer successfully!",
            'status' => 201
        ]);
    }
}
