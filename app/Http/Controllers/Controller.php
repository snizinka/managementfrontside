<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function home() {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ])->get('http://127.0.0.1:8000/api/restaurants');

        if ($response->status() == 401) {
            dd("Problems");
        }

        $restaurants = $response->json()['data'];

        return view('home', compact('restaurants'));
    }
}
