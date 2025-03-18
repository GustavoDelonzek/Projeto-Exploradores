<?php

namespace App\Http\Controllers;

use App\Models\Explorer;
use App\Models\User;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(User $user){
        return $user->location;
    }
}
