<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RestaurantController extends Controller
{
    public function restaurant(Request $request) {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ])->get('http://127.0.0.1:8000/api/restaurant/1')->json();

        dd($response);
    }
}
