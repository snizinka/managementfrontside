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
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->get('http://127.0.0.1:8000/api/restaurants');

        if ($response->status() >= 300) {
            if ($response->status() == 401) {
                $unauthorized = $response->json()['errors'];

                return view('auth.login', compact('unauthorized'));
            }
        }

        $restaurants = $response->json()['data'];

        return view('admin.restaurants.index', compact('restaurants'));
    }

    public function create()
    {
        return view('admin.restaurants.form');
    }
    public function store(Request $request)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->post('http://127.0.0.1:8000/api/restaurants', [
            'name' => $request->restaurantname,
            'address' => $request->restaurantaddress,
            'contacts' => $request->restaurantcontacts,
        ]);

        if ($response->status() >= 300) {
            if ($response->status() == 401) {
                $unauthorized = $response->json()['errors'];

                return view('auth.login', compact('unauthorized'));
            }else {
                $error = $response->json()['errors'];

                return redirect()->route('restaurant.create')->withErrors($error);
            }
        }

        return redirect()->route('restaurant.index');
    }
    public function show(string $id)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->get('http://127.0.0.1:8000/api/restaurants/'.$id);

        if ($response->status() >= 300) {
            if ($response->status() == 401) {
                $unauthorized = $response->json()['errors'];

                return view('auth.login', compact('unauthorized'));
            }
        }

        if($response->json() == []) {
            return redirect()->route('restaurant');
        }

        $restaurants = $response->json()['data'];

        return view('admin.restaurants.show', compact('restaurants'));
    }
    public function edit(string $id)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->get('http://127.0.0.1:8000/api/restaurants/'.$id);


        if ($response->status() >= 300) {
            if ($response->status() == 401) {
                $unauthorized = $response->json()['errors'];

                return view('auth.login', compact('unauthorized'));
            }
        }

        if($response->json() == []) {
            return redirect()->route('restaurant');
        }

        $restaurants = $response->json()['data'];

        return view('admin.restaurants.form', compact('restaurants'));
    }
    public function update(Request $request, string $id)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->post('http://127.0.0.1:8000/api/restaurants/'.$id, [
            'name' => $request->restaurantname,
            'address' => $request->restaurantaddress,
            'contacts' => $request->restaurantcontacts,
        ]);

        if ($response->status() >= 300) {
            if ($response->status() == 401) {
                $unauthorized = $response->json()['errors'];

                return view('auth.login', compact('unauthorized'));
            }else {
                $error = $response->json()['errors'];

                return redirect()->route('restaurant.edit', $id)->withErrors($error);
            }
        }

        return redirect()->route('restaurant.index');
    }
    public function destroy(string $id)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->delete('http://127.0.0.1:8000/api/restaurants/'.$id);

        if ($response->status() >= 300) {
            if ($response->status() == 401) {
                $unauthorized = $response->json()['errors'];

                return view('auth.login', compact('unauthorized'));
            }
        }

        return redirect()->route('restaurant.index');
    }
}
