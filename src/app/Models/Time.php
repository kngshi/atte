<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Http\Controllers\TimeController;

class Time extends Model
{
    use HasFactory;

    protected $guarded = [
        'user_id', 'date', 'work_start', 'work_end'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function rests(){
        return $this->hasMany('App\Models\Rest');
    }
    
}
