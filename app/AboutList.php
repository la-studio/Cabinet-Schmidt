<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AboutList extends Model
{
    protected $fillable = ['name'];

    public function slide()
    {
        return $this->belongsTo('App\AboutSlide');
    }
}
