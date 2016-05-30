<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Echosarticle extends Model
{
    protected $fillable = ['title','auteur','content','rubrique','keyword','image','summary','date'];
    public function references()
    {
        return $this->hasMany(Reference::class);
    }
}
