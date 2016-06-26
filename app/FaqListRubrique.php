<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaqListRubrique extends Model
{
    protected $fillable = ['rubrique'];

    public function keywords()
    {
        return $this->belongsToMany('App\FaqListKeyword', 'faq_list_rubriques_keywords' )->withTimestamps();
    }
}
