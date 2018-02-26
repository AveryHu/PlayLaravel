<?php

namespace App\Http\Controllers;

use App\Vote;
use App\Category;
use App\Votechoice;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;

class VoteResultController extends Controller
{
    //
    public function index(Request $request)
    {
        //
        $votes = '';
        if($request->input('cateid') == null)
            $votes = Vote::all()->where('end', '<', Carbon::now());
        else
            $votes = Vote::all()->where('cateid', $request->input('cateid'))->where('end', '<', Carbon::now());
        return view('resultindex', [
            'current' => $request->input('cateid'), 
            'votes' => $votes, 
            'cates' => Category::all()
            ]);
    }
}
