<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flux_Article extends Model
{
    protected $fillable = ['title','auteur','content','rubrique','keyword','image','summary','date'];
}
