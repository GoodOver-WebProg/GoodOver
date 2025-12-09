<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SellerFoodController extends Controller
{
    // Tampilkan form
    public function create()
    {
        return view('pages.seller-food');
    }

    // Simpan data
    public function store(Request $request)
    {
        Food::create([
            'seller_id'   => auth()->id(), // seller login
            'name'        => $request->name,
            'price'       => $request->price,
            'addon'       => $request->addon,
            'description' => $request->description,
            'image_path'  => $imagePath,
            'pickup_time' => 30,
            'status'      => 'available',
        ]);
        $request->validate([
            'name'        => 'required',
            'price'       => 'nullable|numeric',
            'addon'       => 'nullable|string',
            'description' => 'required',
            'image'       => 'nullable|image',
        ]);

        // Upload image kalau ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('foods', 'public');
        }

        // 👉 sementara kita belum pake database real,
        // jadi ini cuma contoh return
        return back()->with('success', 'Food created successfully!');
    }
}
