<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $fillable = ['id','category_id', 'name', 'image','description'];

    protected $hidden = [];

    public function category(){
        return $this->belongsTo('App\Category', 'category_id');
    }
}
