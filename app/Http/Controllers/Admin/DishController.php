<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DishController extends Controller
{
    public function index()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ])->get('http://127.0.0.1:8000/api/dishes');

        if ($response->status() == 401) {
            dd("Problems");
        }

        $dishes = $response->json()['data'];

        return view('admin.dishes.index', compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $responseC = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ])->get('http://127.0.0.1:8000/api/categories');

        $responseR = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ])->get('http://127.0.0.1:8000/api/restaurants');

        $categories = $responseC->json()['data'];
        $restaurants = $responseR->json()['data'];

        return view('admin.dishes.form', compact(['categories', 'restaurants']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $responseD = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->post('http://127.0.0.1:8000/api/dishes', [
            'name' => $request->dishname,
            'price' => (float)$request->dishprice,
            'ingredients' => $request->dishproducts,
            'category_id' => (int)$request->dishcategory,
            'restaurant_id' => (int)$request->dishrestaurant
        ]);

        return redirect()->route('dish.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ])->get('http://127.0.0.1:8000/api/dishes/'.$id);

        if ($response->status() == 401) {
            return view('notauthenticated');
        }

        $dish = $response->json()['data'];

        return view('admin.dishes.show', compact('dish'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $responseD = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ])->get('http://127.0.0.1:8000/api/dishes/'.$id);

        $responseC = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ])->get('http://127.0.0.1:8000/api/categories');

        $responseR = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ])->get('http://127.0.0.1:8000/api/restaurants');

        if ($responseD->status() == 401 || $responseC->status() == 401 || $responseR->status() == 401) {
            dd("Problems");
        }

        $dish = $responseD->json()['data'];
        $categories = $responseC->json()['data'];
        $restaurants = $responseR->json()['data'];

        return view('admin.dishes.form', compact(['dish', 'categories', 'restaurants']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $responseD = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->post('http://127.0.0.1:8000/api/dishes/'.$id.'/update', [
            'name' => $request->dishname,
            'price' => (float)$request->dishprice,
            'ingredients' => $request->dishproducts,
            'category_id' => (int)$request->dishcategory,
            'restaurant_id' => (int)$request->dishrestaurant
        ]);


        return redirect()->route('dish.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $responseD = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->delete('http://127.0.0.1:8000/api/dishes/'.$id);

        return redirect()->route('dish.index');
    }
}
