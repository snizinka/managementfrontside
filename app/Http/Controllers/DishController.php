<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DishController extends Controller
{
    public function showDish(string $id) {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
        ])->get('http://127.0.0.1:8000/api/dishes/'.$id);

        if ($response->status() >= 300) {
            if ($response->status() == 401) {
                $unauthorized = $response->json()['errors'];

                return view('auth.login', compact('unauthorized'));
            }
        }

        if($response->json() == []) {
            return redirect()->route('restaurant');
        }

        $dish = $response->json()['data'];

        return view('dishes.show', compact('dish'));
    }
}
