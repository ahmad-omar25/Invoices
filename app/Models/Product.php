<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function scopeSelection($query) {
        return $query->select('id', 'name', 'description', 'section_id', 'created_by');
    }

    public function section() {
        return $this->belongsTo(Section::class, 'section_id');
    }

}
