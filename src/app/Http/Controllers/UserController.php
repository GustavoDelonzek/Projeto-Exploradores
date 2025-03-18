<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
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
        $this->authorize('update', $explorer);

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
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => "deleted explorer successfully!",
            'status' => 201
        ]);
    }
}
