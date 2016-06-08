<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Digitreference extends Model
{
    protected $fillable = ['link','label'];
    public function article()
    {
        $this->belongsTo(Digitarticle::class);
    }
}
