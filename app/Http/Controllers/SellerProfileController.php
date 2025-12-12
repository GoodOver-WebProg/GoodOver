<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SellerStore;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SellerProfileController extends Controller
{
    public function edit()
    {
        $store = SellerStore::where('user_id', Auth::id())->first();

        return view('pages.seller-profile', compact('store'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'store_name' => 'required|string|max:255',
            'contact' => 'required|string|max:20',
            'opening_time' => 'required',
            'closing_time' => 'required',
            'address' => 'required|string',
            'image' => 'nullable|image|max:1024',
        ]);

        $store = SellerStore::where('user_id', Auth::id())->first();

        $store->name = $request->store_name;
        $store->contact = $request->contact;
        $store->opening_time = $request->opening_time;
        $store->closing_time = $request->closing_time;
        $store->address = $request->address;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('store', 'public');
            $store->image_path = $path;
        }

        $store->save();

        return back()->with('success', 'Profile updated successfully!');
    }
}
