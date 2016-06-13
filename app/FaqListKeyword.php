<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaqListKeyword extends Model
{
    protected $fillable = ['keyword'];

    public function rubriques()
    {
        return $this->belongsToMany(FaqListRubrique::class,'rubrique_keyword','faq_list_rubrique_id', 'faq_list_keyword_id');
    }
}
