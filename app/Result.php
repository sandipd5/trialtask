<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    //
    public $fillable = ['name','faculty','subject','total_marks','obtained_marks','remarks'];
}
