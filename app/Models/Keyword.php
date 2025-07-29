<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
   protected $fillable = ['category', 'subcategory', 'keyword', 'embedding'];
    protected $casts = [
        'embedding' => 'array',
    ];
}
