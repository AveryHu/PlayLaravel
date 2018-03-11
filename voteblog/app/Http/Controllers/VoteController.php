<?php

namespace App\Http\Controllers;

use App\Vote;
use App\Category;
use App\Votechoice;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;
use App\Votesrecord;

class VoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $votes = '';
        if($request->input('cateid') == null)
            $votes = Vote::all()->where('end', '>', Carbon::now());
        else
            $votes = Vote::all()->where('cateid', $request->input('cateid'))->where('end', '>', Carbon::now());
        return view('index', [
            'current' => $request->input('cateid'), 
            'votes' => $votes, 
            'cates' => Category::all()
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('forms/votecreate', ['categorys' => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules = [
            'title' => 'required',
            'content' => 'required',
            'mainimage' => 'mimes:jpeg,bmp,png,jpg,',
            'start' => 'required',
            'end' => 'required',
            'name.*' => 'required',
            'image.*' => 'mimes:jpeg,bmp,png,jpg,'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        } else {
            $filename = '';
            if ($request->hasFile('mainimage')) {
                if ($request->file('mainimage')->isValid()){
                    $destinationPath = base_path() . '/public/upload_img';
                    // getting image extension
                    $extension = $request->file('mainimage')->getClientOriginalExtension();
                    $fileName = Carbon::now()->timestamp . '_store_.' . $extension;                
                    // move file to dest
                    $request->file('mainimage')->move($destinationPath, $fileName);                    
                }
            }

            $vote = Vote::create([
                'title' => $request->title,
                'cateid' => $request->category,
                'image' => $fileName,
                'content' => $request->content,
                'start' => $request->start,
                'end' => $request->end,
            ]);
            
            foreach($request->input('name') as $key => $value) {
                $subfileName = '';
                if ($request->hasFile('image.'.$key)) {
                    if ($request->file('image')[$key]->isValid()){
                        $destinationPath = base_path() . '/public/upload_img';
                        $extension = $request->file('image')[$key]->getClientOriginalExtension();
                        $subfileName = $vote->id . '_' . $key . '_choice_.' . $extension;                
                        $request->file('image')[$key]->move($destinationPath, $subfileName);
                    }
                }
                Votechoice::create([
                    'voteid' => $vote->id,
                    'image' => $subfileName,
                    'name' => $value,
                    'ticket' => 0
                ]);
            }
        }
        return response()->json(['success'=>'done']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function show(Vote $vote)
    {
        //
        $vote = Vote::all()->where('id', $vote->id)->first();
        $choices = Votechoice::all()->where('voteid', $vote->id);
        $cate = Category::all()->where('id', $vote->cateid)->first();
        return view('forms/vote', ['vote' => $vote, 'choices' => $choices, 'cate' =>$cate]);;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function edit(Vote $vote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vote $vote)
    {
        //
        $check = Votesrecord::all()->where('voteid', $vote->id)
        ->where('userid', auth()->user()->id)->first();
        if($check)
        {
            $warning=array("No chance"=>"You already voted this.");
            return response()->json(['error'=>$warning]);
        }
        Votesrecord::create([
            'userid' => auth()->user()->id,
            'voteid' => $vote->id,
            'votenumber' => $request->select
        ]);
        $choice = Votechoice::all()->where('voteid', $vote->id)
        ->where('id', $request->select)->first()->increment('ticket');        
        return response()->json(['success'=>'done']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vote $vote)
    {
        //
    }
}
