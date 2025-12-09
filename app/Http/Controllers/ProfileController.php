<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showProfile()
    {
        // Jika user belum login → redirect ke login page
        // if (!Auth::check()) {
        //     return redirect()->route('route.login.view');
        // }

        // Ambil user yang sedang login
        // $user = Auth::user();

        $user = User::find(1); //temporary buat ambil data dgn id 1
        return view('pages.profile', compact('user'));
    }
}
