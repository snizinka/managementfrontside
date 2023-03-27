<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CartController extends Controller
{
    public function showCart() {
        $response = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->get('http://127.0.0.1:8000/api/cart');

        if ($response->status() >= 300) {
            if ($response->status() == 401) {
                $unauthorized = $response->json()['errors'];

                return view('auth.login', compact('unauthorized'));
            }else {
                $error = $response->json();
                $dishes = [];
                $total = 0;
                $unavailable = 0;
                return view('cart.index', compact('dishes', 'total', 'unavailable'))->withErrors($error);
            }
        }

        $dishes = $response->json();

        if ($dishes == []) {
            return view('cart.index', compact('dishes'));
        }

        $unavailable = 0;
        $dishes = $dishes['data']['relationships']['order_items'];
        $total = 0;
        foreach ($dishes as $dish) {
            foreach ($dish['relationships']['items'] as $order_item) {
                $total += (float) $order_item['dish']['price'] * $order_item['count'];
                $unavailable += $order_item['availability'] == 'available' ? 0 : 1;
            }
        }

        return view('cart.index', compact('dishes', 'total', 'unavailable'));
    }

    public function addToCart(string $id) {
        $response = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->post('http://127.0.0.1:8000/api/cart/add', [
            'id' => $id,
        ]);

        if ($response->status() >= 300) {
            if ($response->status() == 401) {
                $unauthorized = $response->json()['errors'];

                return view('auth.login', compact('unauthorized'));
            }else {
                $error = $response->json()['errors'];
                return redirect()->route('cart.index')->withErrors($error);
            }
        }

        if ($response->status() != 200) {
            if ($response->status() == 401) {
                $unauthorized = $response->json()['errors'];

                return view('auth.login', compact('unauthorized'));
            }
        }

        return redirect()->route('cart');
    }

    public function removeItem(string $id) {
        $response = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->delete('http://127.0.0.1:8000/api/cart/remove', [
            'id' => $id,
        ]);

        if ($response->status() != 200) {
            if ($response->status() == 401) {
                $unauthorized = $response->json()['errors'];

                return view('auth.login', compact('unauthorized'));
            }
        }

        return redirect()->route('cart');
    }
}
