<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
