<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Temoignage extends Model
{
  protected $fillable = ['title','content','person_job','person_identity'];
}
