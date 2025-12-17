<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessCategory extends Model
{
    protected $guarded = [];

    public function children()
    {
        return $this->hasMany(BusinessCategory::class, 'parent_id');
    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }
}
