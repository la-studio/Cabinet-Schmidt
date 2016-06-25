<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AboutSlide extends Model
{
    protected $fillable = ['cover','title','summary'];

    public function list_item()
    {
        return $this->hasMany(AboutList::class);
    }
}
