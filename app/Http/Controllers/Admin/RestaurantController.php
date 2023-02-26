<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RestaurantController extends Controller
{
    public function index()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ])->get('http://127.0.0.1:8000/api/restaurants');

        if ($response->status() == 401) {
            dd("Problems");
        }

        $restaurants = $response->json()['data'];

        return view('restaurants.index', compact('restaurants'));
    }

    public function create()
    {
        return view('restaurants.form');
    }
    public function store(Request $request)
    {
        $responseD = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->post('http://127.0.0.1:8000/api/restaurants', [
            'name' => $request->restaurantname,
            'address' => $request->restaurantaddress,
            'contacts' => $request->restaurantcontacts,
        ]);

        return redirect()->route('restaurant.index');
    }
    public function show(string $id)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ])->get('http://127.0.0.1:8000/api/restaurants/'.$id);

        if ($response->status() == 401) {
            dd("Problems");
        }

        $restaurants = $response->json()['data'];

        return view('restaurants.show', compact('restaurants'));
    }
    public function edit(string $id)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ])->get('http://127.0.0.1:8000/api/restaurants/'.$id);


        if ($response->status() == 401) {
            dd("Problems");
        }

        $restaurants = $response->json()['data'];

        return view('restaurants.form', compact('restaurants'));
    }
    public function update(Request $request, string $id)
    {
        $responseD = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->post('http://127.0.0.1:8000/api/restaurants/'.$id, [
            'name' => $request->restaurantname,
            'address' => $request->restaurantaddress,
            'contacts' => $request->restaurantcontacts,
        ]);

        return redirect()->route('restaurant.index');
    }
    public function destroy(string $id)
    {
        $responseD = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->delete('http://127.0.0.1:8000/api/restaurants/'.$id);

        return redirect()->route('restaurant.index');
    }
}
