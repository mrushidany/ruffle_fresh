<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected   $fillable = ['name','no_of_winners','image'];

    public function drawType(){
        return $this->belongsTo('App\Models\DrawType');
    }
}
