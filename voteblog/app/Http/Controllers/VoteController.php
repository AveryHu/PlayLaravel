<?php

namespace App\Http\Controllers;

use App\Vote;
use App\Category;
use App\Votechoice;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('index');
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
        return 'Hello show';
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
