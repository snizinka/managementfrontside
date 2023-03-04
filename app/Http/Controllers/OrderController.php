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
        $responseD = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->post('http://127.0.0.1:8000/api/order/place', [
            'address' => $request->address,
            'phone' => $request->phone,
            'username' => $request->username,
        ]);
    }
}
