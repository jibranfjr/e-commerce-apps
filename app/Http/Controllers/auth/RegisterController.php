<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:4',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->email === 'admin@gmail.com' ? 'admin' : 'customer',
        ]);

        // langsung login
        Auth::login($user);

        // trigger event registered (otomatis kirim email verifikasi)
        event(new Registered($user));

        return redirect()->route('register.form')
        ->with('success', 'Akun berhasil dibuat! Link verifikasi telah dikirim ke email Anda.');
    }
}