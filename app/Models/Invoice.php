<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = [];

    public function section() {
        return $this->belongsTo(Section::class, 'section_id');
    }

}
