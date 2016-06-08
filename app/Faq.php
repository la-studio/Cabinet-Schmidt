<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = ['question','reponse','title','rubrique'];

    public function keywords()
    {
      return $this->hasMany(FaqKeyword::class);
    }
    public function references()
    {
      return $this->hasMany(FaqReference::class);
    }
}
