<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    //
    protected $fillable = [
        'title', 'cateid', 'image',
        'content', 'start', 'end'
    ];
}
