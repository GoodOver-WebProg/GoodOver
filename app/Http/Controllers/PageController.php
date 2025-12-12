<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function homepage()
    {
        return view('pages.homepage');
    }

    public function detailPage()
    {
        return view('pages.detailpage');
    }

    public function userRegister(){
        return view('pages.register');
    }

    public function sellerRegister() {
        
        return view('pages.seller.register');
    }
}
