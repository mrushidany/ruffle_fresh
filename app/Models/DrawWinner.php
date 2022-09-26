<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrawWinner extends Model
{
    use HasFactory;

    protected  $fillable = ['draw_id','phone_number','category_id'];

    public function draw(){
        return $this->belongsTo('App\Models\Draw');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function participant(){
        return $this->belongsTo('App\Models\Participant','phone_number','phone_number');
    }
}
