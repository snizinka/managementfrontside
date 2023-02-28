<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DriverController extends Controller
{
    public function getDrivers() {
        $response = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->get('http://127.0.0.1:8000/api/drivers');

        if ($response->status() >= 300) {
            if ($response->status() == 401) {
                $unauthorized = $response->json()['errors'];

                return view('auth.login', compact('unauthorized'));
            }
        }

        $drivers = $response->json();

        if ($drivers == []) {
            return view('admin.drivers.index', compact('drivers'));
        }

        $drivers = $drivers['data'];
        return view('admin.drivers.index', compact('drivers'));
    }

    public function showDriver(string $id) {
        $response = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->get('http://127.0.0.1:8000/api/drivers/'.$id);

        if ($response->status() >= 300) {
            if ($response->status() == 401) {
                $unauthorized = $response->json()['errors'];

                return view('auth.login', compact('unauthorized'));
            }
        }

        $drivers = $response->json();

        if ($drivers == []) {
            return view('admin.drivers.index', compact('drivers'));
        }

        $driver = $drivers['data'];
        return view('admin.drivers.show', compact('driver'));
    }

    public function addDriver() {
        return view('admin.drivers.form');
    }

    public function insertDriver(Request $request) {
        $response = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->post('http://127.0.0.1:8000/api/drivers', [
            'lastname' => $request->lastname,
            'name' => $request->name,
        ]);

        if ($response->status() >= 300) {
            if ($response->status() == 401) {
                $unauthorized = $response->json()['errors'];

                return view('auth.login', compact('unauthorized'));
            }else {
                $error = $response->json()['errors'];

                return redirect()->route('addDriver')->withErrors($error);
            }
        }

        if ($response->status() >= 300) {
            if ($response->status() == 401) {
                $unauthorized = $response->json()['errors'];

                return view('auth.login', compact('unauthorized'));
            }
        }

        return redirect()->route('getDrivers');
    }

    public function updateFormDriver(string $id) {
        $response = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->get('http://127.0.0.1:8000/api/drivers/'.$id);

        if ($response->status() >= 300) {
            if ($response->status() == 401) {
                $unauthorized = $response->json()['errors'];

                return view('auth.login', compact('unauthorized'));
            }
        }

        $driver = $response->json()['data'];

        return view('admin.drivers.form', compact('driver'));
    }

    public function updateDriver(Request $request, string $id) {
        $response = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->put('http://127.0.0.1:8000/api/drivers/'.$id, [
            'lastname' => $request->lastname,
            'name' => $request->name,
        ]);

        if ($response->status() >= 300) {
            if ($response->status() == 401) {
                $unauthorized = $response->json()['errors'];

                return view('auth.login', compact('unauthorized'));
            }else {
                $error = $response->json()['errors'];

                return redirect()->route('updateFormDriver', $id)->withErrors($error);
            }
        }

        return redirect()->route('getDrivers');
    }

    public function removeDriver(string $id) {
        $response = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->delete('http://127.0.0.1:8000/api/drivers/'.$id);

        if ($response->status() >= 300) {
            if ($response->status() == 401) {
                $unauthorized = $response->json()['errors'];

                return view('auth.login', compact('unauthorized'));
            }
        }

        return redirect()->route('getDrivers');
    }
}
