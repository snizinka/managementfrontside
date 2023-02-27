<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $response = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
        ])->post('http://127.0.0.1:8000/api/login', [
            'email' => $request->email,
            'password' => $request->password
        ]);

        if ($response->status() != 200) {
            $error = $response->json()['errors'];

            return view('auth.login', compact('error'));
        }

        if ($response->status() == 401) {
            return redirect()->route('login', compact($response->json()['data']));
        }
        $response = $response->json();

        session(['token' => $response['data']['token']]);
        session(['role' => $response['data']['user']['role']]);

        return redirect()->route('home');
    }

    public function showSignup() {
        return view('auth.signup');
    }

    public function signup(Request $request) {
        $response = Http::withHeaders([
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
        ])->post('http://127.0.0.1:8000/api/register', [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation
        ]);

        if ($response->status() != 200) {
            $error = $response->json()['errors'];

            return view('auth.signup', compact('error'));
        }

        return redirect()->route('login');
    }

    public function logout() {
        Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
        ])->post('http://127.0.0.1:8000/api/logout')->json();

        Session::forget(['role', 'token']);

        return redirect()->route('login');
    }
}
