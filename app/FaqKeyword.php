<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaqKeyword extends Model
{
    protected $fillable = ['keyword'];
    
    public function faq()
    {
        $this->belongsTo(Faq::class);
    }
}
