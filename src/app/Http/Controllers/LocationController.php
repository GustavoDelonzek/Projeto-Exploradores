<?php

namespace App\Http\Controllers;

use App\Models\Explorer;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(Explorer $explorer){
        return $explorer->location;
    }
}
