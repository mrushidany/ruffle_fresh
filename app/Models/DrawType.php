<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrawType extends Model
{
    use HasFactory;

    protected  $fillable = ['name'];

    public function categories(){
        return $this->hasMany('App\Models\Categories');
    }
}
