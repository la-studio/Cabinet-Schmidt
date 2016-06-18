<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaqKeyword extends Model
{
    protected $fillable = ['keyword'];

    public function faq()
    {
        return $this->belongsTo('App\Faq','id');
    }
}
