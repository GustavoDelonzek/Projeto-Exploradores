<?php

namespace App\Http\Controllers;

use App\Models\Explorer;
use App\Models\Inventory;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class ExplorerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
    }

    /**
     * Display the specified resource.
     */
    public function show(User $explorer)
    {

        return response()->json([
            $explorer->load('collectible_item')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $explorer)
    {
        $explorer->update(
            $request->validate([
                'latitude' => 'sometimes|string',
                'longitude' => 'sometimes|string'
            ])
        );

        $location = Location::create([
            'user_id' => $explorer->id,
            'latitude' => $explorer->latitude,
            'longitude' => $explorer->longitude
        ]);

        return $explorer;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $explorer)
    {
        $explorer->delete();

        return response()->json([
            'message' => "deleted explorer successfully!",
            'status' => 201
        ]);
    }
}
