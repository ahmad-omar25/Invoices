<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['name', 'description', 'created_by'];

    public function scopeSelection($query) {
        return $query->select('id', 'name', 'created_by', 'description');
    }

    public function products() {
        return $this->hasMany(Product::class, 'section_id');
    }
}
