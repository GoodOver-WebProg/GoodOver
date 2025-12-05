<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller {
    public function login(Request $request) {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:5|alpha_num'
        ];
        $notification = [
            'required' => 'Semua atribute wajib diisi',
            'email' => 'Format email belum sesuai (Harus mengandung @)',
            'min' => ':Attribute minimal berisi :min karakter',
        ];

        $validator = Validator::make($request->all(), $rules, $notification);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if (Auth::attempt($validator->validated())) {
            $request->session()->regenerate();
            return "berhasil";
        }
    }

    public function register(Request $request) {
        $rules = [
            'email' => 'required|email',
            'username' => 'required',
            'password' => 'required|min:5|alpha_num'
        ];
        $notification = [
            'required' => 'Semua atribute wajib diisi',
            'email' => 'Format email belum sesuai (Harus mengandung @)',
            'min' => ':Attribute minimal berisi :min karakter',
        ];


        $validator = Validator::make($request->all(), $rules, $notification);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();

        $user = User::create([
            'name' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        return redirect()->route('route.login.view')->with('success', 'Registration successful! Please login.');
    }
}
