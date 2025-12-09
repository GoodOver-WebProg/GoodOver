<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function homepage()
    {
        $user = Auth::user();
        return view('pages.homepage',compact('user'));
    }

    public function detailPage()
    {
        return view('pages.detailpage');
    }
}
