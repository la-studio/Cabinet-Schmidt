<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    protected $fillable = ['link','label'];
    public function article()
    {
        $this->belongsTo(Echosarticle::class);
    }
}
