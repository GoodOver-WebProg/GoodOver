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
        $user = User::findOrFail($id);
        return view('pages.profile', compact('user'));
    }

    public function showHistory($id)
    {
        $user = User::findOrFail($id);
        $orders = Order::with('items.product')->where('user_id', $id)->latest()->paginate(10);

        return view('pages.history', compact('user', 'orders'));
    }
}
