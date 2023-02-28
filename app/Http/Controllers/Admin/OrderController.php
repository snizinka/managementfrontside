<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function index()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->get('http://127.0.0.1:8000/api/orders');

        if ($response->status() != 200) {
            if ($response->status() == 401) {
                $unauthorized = $response->json()['errors'];

                return view('auth.login', compact('unauthorized'));
            }
        }

        $orders = $response->json()['data'];

        return view('admin.orders.index', compact('orders'));
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
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->get('http://127.0.0.1:8000/api/orders/'.$id);

        if ($response->status() != 200) {
            if ($response->status() == 401) {
                $unauthorized = $response->json()['errors'];

                return view('auth.login', compact('unauthorized'));
            }
        }

        $orders = $response->json()['data'];

        return view('admin.orders.show', compact('orders'));
    }

    public function edit(string $id)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->get('http://127.0.0.1:8000/api/orders/'.$id);

        $responseB = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->get('http://127.0.0.1:8000/api/drivers');

        if ($response->status() >= 300 || $responseB->status() >= 300) {
            if ($response->status() >= 300 || $responseB->status() >= 300) {
                $unauthorized = $response->json()['errors'] == null ? $responseB->json()['errors'] : $response->json()['errors'];

                return view('auth.login', compact('unauthorized'));
            }
        }

        $orders = $response->json()['data'];
        $drivers = $responseB->json()['data'];

        return view('admin.orders.form', compact('orders', 'drivers'));
    }


    public function update(Request $request, string $id)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->post('http://127.0.0.1:8000/api/drivers/'.$id, [
            'driver' => $request->orderdriver,
        ]);

        if ($response->status() != 200) {
            if ($response->status() == 401) {
                $unauthorized = $response->json()['errors'];

                return view('auth.login', compact('unauthorized'));
            }
        }

        return redirect()->route('order.index');
    }


    public function destroy(string $id)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->delete('http://127.0.0.1:8000/api/orders/'.$id);

        if ($response->status() != 200) {
            if ($response->status() == 401) {
                $unauthorized = $response->json()['errors'];

                return view('auth.login', compact('unauthorized'));
            }
        }

        return redirect()->route('order.index');
    }
}
