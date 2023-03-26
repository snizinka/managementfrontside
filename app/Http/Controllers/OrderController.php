<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function orderForm() {
        return view('orders.form');
    }

    public function order(Request $request) {
        $response = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->post('http://127.0.0.1:8000/api/order/place', [
            'address' => $request->address,
            'phone' => $request->phone,
            'username' => $request->username,
        ]);

        if ($response->status() >= 300) {
            if ($response->status() == 401) {
                $unauthorized = $response->json()['errors'];

                return view('auth.login', compact('unauthorized'));
            }else {

                $error = $response->json();

                return redirect()->route('cart')->withErrors($error);
            }
        }

        if ($response->status() != 200) {
            if ($response->status() == 401) {
                $unauthorized = $response->json()['errors'];

                return view('auth.login', compact('unauthorized'));
            }
        }

        return redirect()->route('home');
    }
}
