<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    protected $fillable = ['id', 'name'];

    protected $hidden = ['foto'];

    public function products(){
        return $this->hasMany('App\Product');
    }
}
