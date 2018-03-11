<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Votesrecord extends Model
{
    //
    protected $fillable = [
        'userid', 'voteid', 'votenumber'
    ];
}
