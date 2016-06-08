<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaqReference extends Model
{
    protected $fillable = ['link','label'];

    public function faq($value='')
    {
        $this->belongsTo(Faq::class);
    }
}
