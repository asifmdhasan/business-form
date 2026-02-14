<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    protected $guarded = [];

    public function business()
    {
        return $this->belongsTo(GmeBusinessForm::class);
    }
}
