<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrandWinner extends Model
{
    use HasFactory;

    protected $fillable = ['participant_id','status'];

    public function participant(){
        return $this->belongsTo('App\Models\Participant');
    }
}
