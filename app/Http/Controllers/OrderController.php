<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function index()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ])->get('http://127.0.0.1:8000/api/orders');

        if ($response->status() == 401) {
            dd("Problems");
        }

        $orders = $response->json()['data'];

        return view('orders.index', compact('orders'));
    }


    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function show(string $id)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ])->get('http://127.0.0.1:8000/api/orders/'.$id);

        if ($response->status() == 401) {
            dd("Problems");
        }

        $orders = $response->json()['data'];

        return view('orders.show', compact('orders'));
    }

    public function edit(string $id)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ])->get('http://127.0.0.1:8000/api/orders/'.$id);

        $responseB = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ])->get('http://127.0.0.1:8000/api/drivers');

        if ($response->status() == 401 || $responseB->status() == 401) {
            dd("Problems");
        }

        $orders = $response->json()['data'];
        $drivers = $responseB->json()['data'];

        return view('orders.form', compact('orders', 'drivers'));
    }


    public function update(Request $request, string $id)
    {
        $responseD = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->post('http://127.0.0.1:8000/api/drivers/'.$id, [
            'driver' => $request->orderdriver,
        ]);

        return redirect()->route('order.index');
    }


    public function destroy(string $id)
    {
        $responseD = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->delete('http://127.0.0.1:8000/api/orders/'.$id);

        return redirect()->route('order.index');
    }
}
