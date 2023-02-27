<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DishController extends Controller
{
    public function showDish(string $id) {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ])->get('http://127.0.0.1:8000/api/dishes/'.$id);

        if ($response->status() == 401) {
            dd("Problems");
        }

        $dish = $response->json()['data'];

        return view('dishes.show', compact('dish'));
    }

    public function addToCart(string $id) {
        $responseD = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->post('http://127.0.0.1:8000/api/cart/add', [
            'id' => $id,
        ]);

        return redirect()->route('dishes', $id);
    }
}
