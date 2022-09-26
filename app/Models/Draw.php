<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Draw extends Model
{
    use HasFactory;

    protected $fillable = ['participants','no_of_winners','schedule','draw_type_id'];

    public function drawType(){
        return $this->belongsTo('App\Models\DrawType');
    }

    public function drawWinners(){
        return $this->hasMany('App\Models\DrawWinner');
    }
}
