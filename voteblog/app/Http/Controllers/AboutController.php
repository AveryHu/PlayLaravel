<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\About;

class AboutController extends Controller
{
    public function index($subpage = '')
    {
        $abouts = About::all();
        return view('about', [
            'abouts' => $abouts,
            'subpage' => $subpage
        ]);
    }

    public function create(Request $request)
    {        
        $about = About::create($request->all());
        $abouts = About::all();
        return view('about', [
            'abouts' => $abouts,
            'subpage' => ''
        ]);
    }
}
