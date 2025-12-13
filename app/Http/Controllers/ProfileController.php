<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showProfile($id)
    {
        // Jika user belum login → redirect ke login page
        // if (!Auth::check()) {
        //     return redirect()->route('route.login.view');
        // }

        // Ambil user yang sedang login
        // $user = Auth::user();

        $user = User::findOrFail($id); //temporary buat ambil data dgn id 1
        return view('pages.profile', compact('user'));
    }
    public function showHistory($id)
    {
        $user = User::findOrFail($id);

        // Ambil data order milik user, urutkan dari yang terbaru
        // paginate(10) membatasi 10 data per halaman
        $orders = Order::with('items.product')->where('user_id', $id)->latest()->paginate(10);

        return view('pages.history', compact('user', 'orders'));
    }
}
