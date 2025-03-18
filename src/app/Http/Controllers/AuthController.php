<?php

namespace App\Http\Controllers;

use App\Models\Explorer;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'username' => 'required|string',
            'password' => 'required'
        ]);
        $user = User::where('username', $request->username)->first();

        if(!$user){
           throw ValidationException::withMessages([
                'username' => ['invalid username!']
            ]);
        }

        if(!Hash::check($request->password, $user->password)){
            throw ValidationException::withMessages([
                'password' => ['invalid password!']
            ]);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'token' => $token
        ]);

    }

    public function register(Request $request){

        $explorer = $request->validate([
            'name' => 'required|string|max:80',
            'age' => 'required|integer|between:0,100',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:4'
        ]);

        $explorer['password'] = Hash::make($explorer['password']);

        $explorer = User::create($explorer);

        $location = Location::create([
            'user_id' => $explorer->id,
            'latitude' => $explorer->latitude,
            'longitude' => $explorer->longitude
        ]);


        return response(status: 201);
    }
}
