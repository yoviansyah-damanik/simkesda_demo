<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

class AboutController extends FrontendController
{
    public function index()
    {
        return view('frontend.pages.about');
    }
}
