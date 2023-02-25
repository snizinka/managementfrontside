<?php

namespace App\Http\Controllers;

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

        return view('dishes.index', compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dishes.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
            dd("Problems");
        }

        $dish = $response->json()['data'];

        return view('dishes.show', compact('dish'));
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

        return view('dishes.form', compact(['dish', 'categories', 'restaurants']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $responseD = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ])->put('http://127.0.0.1:8000/api/dishes/'.$id, [
            'form_params' => [
                'email' => 'test@gmail.com',
                'name' => 'Test user',
                'password' => 'testpassword',
            ]]);

        dd($responseD->json());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
