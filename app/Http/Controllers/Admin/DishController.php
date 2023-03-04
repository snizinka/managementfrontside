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
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
        ])->get('http://127.0.0.1:8000/api/dishes');

        if ($response->status() >= 300) {
            if ($response->status() == 401) {
                $unauthorized = $response->json()['errors'];

                return view('auth.login', compact('unauthorized'));
            }
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
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
        ])->get('http://127.0.0.1:8000/api/categories');

        $responseR = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
        ])->get('http://127.0.0.1:8000/api/restaurants');

        if ($responseC->status() >= 300) {
            if ($responseC->status() == 401) {
                $unauthorized = $responseC->json()['errors'];

                return view('auth.login', compact('unauthorized'));
            }
        }else if ($responseR->status() >= 300) {
            if ($responseR->status() == 401) {
                $unauthorized = $responseR->json()['errors'];

                return view('auth.login', compact('unauthorized'));
            }
        }

        $categories = $responseC->json()['data'];
        $restaurants = $responseR->json()['data'];

        return view('admin.dishes.form', compact(['categories', 'restaurants']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->post('http://127.0.0.1:8000/api/dishes', [
            'name' => $request->dishname,
            'price' => $request->dishprice,
            'ingredients' => $request->dishproducts,
            'category_id' => (int)$request->dishcategory,
            'restaurant_id' => (int)$request->dishrestaurant
        ]);

        if ($response->status() >= 300) {
            if ($response->status() == 401) {
                $unauthorized = $response->json()['errors'];

                return view('auth.login', compact('unauthorized'));
            }else {
                $error = $response->json()['errors'];

                return redirect()->route('dish.create')->withErrors($error);
            }
        }

        return redirect()->route('dish.index');
    }

    public function show(string $id)
    {
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

        return view('admin.dishes.show', compact('dish'));
    }

    public function edit(string $id)
    {
        $responseD = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
        ])->get('http://127.0.0.1:8000/api/dishes/'.$id);

        $responseC = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
        ])->get('http://127.0.0.1:8000/api/categories');

        $responseR = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
        ])->get('http://127.0.0.1:8000/api/restaurants');

        if ($responseD->status() >= 300) {
            if ($responseD->status() == 401) {
                $unauthorized = $responseD->json()['errors'];

                return view('auth.login', compact('unauthorized'));
            }
        }else if ($responseC->status() >= 300) {
            if ($responseC->status() == 401) {
                $unauthorized = $responseC->json()['errors'];

                return view('auth.login', compact('unauthorized'));
            }
        } else if ($responseR->status() >= 300) {
            if ($responseR->status() == 401) {
                $unauthorized = $responseR->json()['errors'];

                return view('auth.login', compact('unauthorized'));
            }
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
        $response = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->post('http://127.0.0.1:8000/api/dishes/'.$id.'/update', [
            'name' => $request->dishname,
            'price' => $request->dishprice,
            'ingredients' => $request->dishproducts,
            'category_id' => (int)$request->dishcategory,
            'restaurant_id' => (int)$request->dishrestaurant
        ]);

        if ($response->status() >= 300) {
            if ($response->status() == 401) {
                $unauthorized = $response->json()['errors'];

                return view('auth.login', compact('unauthorized'));
            }else {
                $error = $response->json()['errors'];


                return redirect()->route('dish.edit', $id)->withErrors($error);
            }
        }

        return redirect()->route('dish.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->delete('http://127.0.0.1:8000/api/dishes/'.$id);

        if ($response->status() >= 300) {
            if ($response->status() == 401) {
                $unauthorized = $response->json()['errors'];

                return view('auth.login', compact('unauthorized'));
            }
        }

        return redirect()->route('dish.index');
    }
}
