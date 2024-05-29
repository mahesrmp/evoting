<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function prosesRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make('123'),
        ]);

        if ($user) {
            return redirect()->route('login')->with('success', 'Registration successful. You can now log in.');
        } else {
            return redirect()->back()->with('error', 'Cannot Registration. Try Again');
        }
    }

    public function login()
    {
        return view('auth.login');
    }

    public function proseslogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $input = $request->all();

        $user = User::where('username', $input['username'])->first();

        if ($user && auth()->attempt(array('username' => $input['username'], 'password' => $input['password']))) {
            if (auth()->user()->role == "admin") {
                return redirect('/dataCalonKomandanResimen');
            } else if (auth()->user()->role == "pemilih") {
                return redirect('/dashboard/pemilih');
            }
        }

        return back()->with('warning', 'Login Failed!!')->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
