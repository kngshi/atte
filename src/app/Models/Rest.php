<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Http\Controllers\RestController;

class Rest extends Model
{
    use HasFactory;

    protected $fillable = [ 'time_id', 'rest_start', 'rest_end'];

    public function time(){
        return $this->belongsTo(Time::class);
    }

}
