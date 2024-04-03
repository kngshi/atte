<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Http\Controllers\TimeController;

class Time extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'date', 'work_start', 'work_end'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function rest(){

        return $this->hasMany(Rest::class);
    }


}
