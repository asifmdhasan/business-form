<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessPhoto extends Model
{
    protected $guarded = [];
    public function business()
    {
        return $this->belongsTo(GmeBusinessForm::class, 'gme_business_form_id');
    }
}
