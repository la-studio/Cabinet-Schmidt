<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    public function article()
    {
        $this->belongsTo(Echosarticle::class);
    }
}
