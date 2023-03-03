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
            'password' => $request->password,
            'remember' => $request->remember
        ]);

        if ($response->status() >= 300) {
            $error = $response->json()['errors'];

            return redirect()->route('login')->withErrors($error);
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

        if ($response->status() >= 300) {
            $error = $response->json()['errors'];

            return view('auth.signup', compact('error'))->withErrors($error);
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

    public function resetView() {
        return view('auth.reset');
    }

    public function reset(Request $request) {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
        ])->post('http://127.0.0.1:8000/api/reset', [
            'email' => $request->email
        ]);

        if ($response->status() >= 300) {
            $error = $response->json()['errors'];

            return redirect()->route('resetView')->withErrors($error);
        }

        Session::forget(['role', 'token']);

        return redirect()->route('login');
    }

    public function resetpassword() {

        return view('auth.newpassword');
    }

    public function confirmReset(Request $request) {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/vnd.api+json',
            'Content-Type' => 'application/vnd.api+json',
        ])->put('http://127.0.0.1:8000/api/reset', [
            'password' => $request->password,
            'confirm' => $request->confirm
        ]);

        if ($response->status() >= 300) {
            $error = $response->json()['errors'];

            return redirect()->route('resetpassword')->withErrors($error);
        }

        Session::forget(['role', 'token']);
        return redirect()->route('login');
    }
}
