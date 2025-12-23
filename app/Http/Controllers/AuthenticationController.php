<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller {
    public function login(Request $request) {
        try {
            $rules = [
                'email' => 'required|email|exists:users,email',
                'password' => 'required|min:5|alpha_num'
            ];
            $notification = [
                'required'  => __('auth.Messages.required'),
                'email'     => __('auth.Messages.email'),
                'min'       => __('auth.Messages.min'),
                'alpha_num' => __('auth.Messages.alpha_num'),
                'exists'    => __('auth.Messages.exists'),
            ];

            $validator = Validator::make($request->all(), $rules, $notification);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $credentials = $validator->validated();

            if (!Auth::attempt($credentials)) {
                return back()->withErrors(['email' => __('auth.failed')])
                            ->withInput();
            }else{
                $request->session()->regenerate();
                return redirect()->route('home');
            }

        } catch (Exception $error) {
            return $error;
        }
    }

    public function register(Request $request) {
        try {
            $rules = [
                'email' => 'required|email|unique:users,email',
                'username' => 'required|unique:users,username',
                'password' => 'required|min:5|alpha_num'
            ];

            $messages = [
                'required'  => __('auth.Messages.required'),
                'email'     => __('auth.Messages.email'),
                'min'       => __('auth.Messages.min'),
                'alpha_num' => __('auth.Messages.alpha_num'),
                'unique'    => __('auth.Messages.unique'),
            ];

            $attributes = [
                'email'    => __('auth.attributes.email'),
                'username' => __('auth.attributes.username'),
                'password' => __('auth.attributes.password'),
            ];

            $validator = Validator::make($request->all(), $rules, $messages, $attributes);


            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $validated = $validator->validated();

            $user = User::create([
                'username' => $validated['username'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password'])
            ]);

            $user->syncRoles(['user']);


            if (Auth::attempt($validator->validated())) {
                $request->session()->regenerate();
                return redirect()->route('home');
            }
        } catch (Exception $error) {
            return $error;
        }
    }

    public function sellerRegister(Request $request) {
        try {
            $rules = [
                'name' => 'required|string|max:255|unique:stores,name',
                'address' => 'required|string',
                'contact' => 'required|string|max:15|unique:stores,contact',
                'location' => 'required|in:Jakarta Utara,Jakarta Barat,Jakarta Timur,Jakarta Selatan,Jakarta Pusat',
                'opening_time' => 'required|date_format:H:i',
                'closing_time' => 'required|date_format:H:i',
                'image_path' => 'required|file|mimes:jpg,jpeg,png',
                'wizard_step' => 'nullable|integer',
            ];

            $messages = [
                'required'    => __('auth.Messages.required'),
                'date_format' => __('auth.Messages.date_format'),
                'mimes'       => __('auth.Messages.mimes'),
                'in'          => __('auth.Messages.in'),
                'unique'      => __('auth.Messages.unique'),
            ];

            $attributes = [
                'name'         => __('auth.attributes.store_name'),
                'address'      => __('auth.attributes.store_address'),
                'contact'      => __('auth.attributes.store_contact'),
                'location'     => __('auth.attributes.store_location'),
                'opening_time' => __('auth.attributes.opening_time'),
                'closing_time' => __('auth.attributes.closing_time'),
                'image_path'   => __('auth.attributes.store_image_path'),
            ];

            $validator = Validator::make($request->all(), $rules, $messages, $attributes);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $validated = $validator->validated();

            $file = $request->file('image_path');
            $dir = public_path('images/stores');
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }

            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->move($dir, $filename);
            $relativePath = 'images/stores/' . $filename;

            Store::create([
                'name' => $validated['name'],
                'address' => $validated['address'],
                'contact' => $validated['contact'],
                'location' => $validated['location'],
                'opening_time' => $validated['opening_time'],
                'closing_time' => $validated['closing_time'],
                'image_path' => $relativePath,
                'user_id' => Auth::id(),
            ]);

            Auth::user()->syncRoles(['seller']);

            return redirect()->route('home');
        } catch (Exception $error) {
            return $error;
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
