<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\About;

class AboutController extends Controller
{
    public function get_about($subpage = '')
    {
        $abouts = About::all();
        return view('about', [
            'abouts' => $abouts,
            'subpage' => $subpage
        ]);
    }

    public function post_about(Request $request)
    {
        return create($request);
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
