<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CartController extends Controller
{
    public function showCart() {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ])->get('http://127.0.0.1:8000/api/cart');

        if ($response->status() == 401) {
            dd("Problems");
        }

        $dishes = $response->json();

        if ($dishes == []) {
            return view('cart.index', compact('dishes'));
        }

        $dishes = $dishes['data'];
        $total = 0;
        foreach ($dishes as $dish) {
            $total += (float) $dish['relationships']['dish']['price'] * $dish['attributes']['count'];
        }

        return view('cart.index', compact('dishes', 'total'));
    }

    public function addToCart(string $id) {
        $responseD = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->post('http://127.0.0.1:8000/api/cart/add', [
            'id' => $id,
        ]);

        return redirect()->route('cart');
    }

    public function removeItem(string $id) {
        $responseD = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->post('http://127.0.0.1:8000/api/cart/remove', [
            'id' => $id,
        ]);

        return redirect()->route('cart');
    }
}
