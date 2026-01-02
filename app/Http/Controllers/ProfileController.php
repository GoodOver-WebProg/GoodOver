<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function showProfile($id)
    {
        $user = User::with('orders')->findOrFail($id);
        $orders = Order::with('items.product')->where('user_id', $id)->latest()->paginate(5);
        $totalOrders = Order::with('items.product')->where('user_id', $id)->count();
        return view('pages.profile', compact('user', 'orders', 'totalOrders'));
    }

    public function editProfile($id) {
        $user = User::findOrFail($id);
        return view('pages.editProfile', compact('user'));
    }

    public function updateProfile(Request $request, $id) {
    try {
        $user = User::findOrFail($id);

        $rules = [
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'username' => 'required|unique:users,username,' . $user->id,
            'password' => 'nullable|min:5|alpha_num|confirmed',
            // Validasi gambar: harus gambar, format jpg/jpeg/png, max 2MB
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ];

        $messages = [
            'required'  => 'Atribut ini wajib diisi',
            'email'     => 'Format email tidak valid',
            'unique'    => 'Data ini sudah digunakan oleh pengguna lain',
            'min'       => 'Minimal :min karakter',
            'alpha_num' => 'Hanya boleh huruf dan angka',
            'confirmed' => 'Konfirmasi password tidak cocok',
            'image'     => 'File harus berupa gambar',
            'mimes'     => 'Format gambar harus jpeg, png, atau jpg',
            'max'       => 'Ukuran gambar maksimal 2MB',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user->username = $request->username;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $path = $request->file('profile_picture')->store('profile_pictures', 'public');

            $user->profile_picture = $path;
        }
        // ----------------------------

        $user->save();

        return redirect()->back()->with('success', 'Profil updated!');

    } catch (\Exception $error) {
        return redirect()->back()->with('error', 'Error message: ' . $error->getMessage());
    }
}

    public function showHistory($id)
    {
        $user = User::findOrFail($id);
        $orders = Order::with('items.product')->where('user_id', $id)->latest()->paginate(10);

        return view('pages.history', compact('user', 'orders'));
    }

}
