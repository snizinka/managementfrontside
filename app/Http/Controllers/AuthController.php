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
        $response = Http::post('http://127.0.0.1:8000/api/login', [
            'email' => $request->email,
            'password' => $request->password
        ])->json();

        if ($response['data'] == '404') {
            return redirect()->route('login');
        }

        session(['token' => $response['data']['token']]);
        session(['role' => $response['data']['user']['role']]);
    }

    public function showSignup() {
        return view('auth.signup');
    }

    public function signup(Request $request) {
        $response = Http::post('http://127.0.0.1:8000/api/register', [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation
        ])->json();

        return redirect()->route('login');
    }

    public function logout() {
        Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ])->post('http://127.0.0.1:8000/api/logout')->json();

        Session::forget(['role', 'token']);

        return redirect()->route('login');
    }
}
