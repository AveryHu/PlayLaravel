<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Votechoice extends Model
{
    //
    protected $fillable = [
    'voteid', 'image', 'name', 'ticket'
    ];
}
