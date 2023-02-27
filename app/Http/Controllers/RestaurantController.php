<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RestaurantController extends Controller
{
    public function getRestaurants() {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ])->get('http://127.0.0.1:8000/api/restaurants');

        if ($response->status() == 401) {
            dd("Problems");
        }

        $restaurants = $response->json()['data'];

        return view('restaurants.index', compact('restaurants'));
    }

    public function getRestaurant(string $id) {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ])->get('http://127.0.0.1:8000/api/restaurants/'.$id);

        $responseD = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ])->get('http://127.0.0.1:8000/api/restaurant/'.$id);

        if ($response->status() == 401 || $responseD->status() == 401) {
            dd("Problems");
        }

        $restaurants = $response->json()['data'];
        $dishes = $responseD->json()['data'];


        return view('restaurants.show', compact('restaurants', 'dishes'));
    }
}
