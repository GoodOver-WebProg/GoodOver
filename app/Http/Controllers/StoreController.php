<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class StoreController extends Controller
{
    public function getProfileBySeller() {
        $store = Auth::user()->store()->firstOrFail();

        return view('pages.seller.editprofile', compact('store'));
    }

    public function updateProfileBySeller(Request $request) {
        try {
            $store = Store::where('user_id', Auth::id())->firstOrFail();

            $rules = [
                'name' => 'required|string|max:255',
                'contact' => 'required|string|max:255',
                'opening_time' => 'required|date_format:H:i:s',
                'closing_time' => 'required|date_format:H:i:s',
                'address' => 'required|string',
                'location' => 'required|string|max:255',
                'image_path' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            ];

            $messages = [
                'required'    => __('auth.Messages.required'),
                'mimes'       => __('auth.Messages.mimes'),
                'max'         => __('auth.Messages.max'),
                'date_format' => __('auth.Messages.date_format'),
            ];

            $attributes = [
                'name' => __('auth.attributes.store_name'),
                'contact' => __('auth.attributes.store_contact'),
                'opening_time' => __('auth.attributes.opening_time'),
                'closing_time' => __('auth.attributes.closing_time'),
                'address' => __('auth.attributes.store_address'),
                'location' => __('auth.attributes.store_location'),
                'image_path' => __('auth.attributes.store_image_path'),
            ];

            $validator = Validator::make($request->all(), $rules, $messages, $attributes);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $validated = $validator->validated();

            $oldImagePath = $store->image_path;

            DB::transaction(function () use ($request, $store, $validated, $oldImagePath) {
                // update fields
                $store->name = $validated['name'];
                $store->contact = $validated['contact'];
                $store->opening_time = $validated['opening_time'];
                $store->closing_time = $validated['closing_time'];
                $store->address = $validated['address'];
                $store->location = $validated['location'];

                if ($request->hasFile('image_path')) {
                    $file = $request->file('image_path');

                    $dir = public_path('images/stores');
                    if (!is_dir($dir)) {
                        mkdir($dir, 0755, true);
                    }

                    $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                    $file->move($dir, $filename);

                    $store->image_path = 'images/stores/' . $filename;

                    DB::afterCommit(function () use ($oldImagePath) {
                        if (!$oldImagePath) return;

                        if (!str_starts_with($oldImagePath, 'images/stores/')) return;

                        $full = public_path($oldImagePath);
                        if (File::exists($full)) {
                            File::delete($full);
                        }
                    });
                }

                $store->save();
            }); 

            return redirect()
                ->route('seller.dashboard')
                ->with('success', __('sellerStoreProfile.update_success'));
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->with('error', __('sellerStoreProfile.update_fail'));
        }
    }
}
