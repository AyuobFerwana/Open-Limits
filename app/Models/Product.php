<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    public function store(){
        return $this->belongsTo(Store::class)->withTrashed();
    }
    public function purchases(){
        return $this->hasMany(Purchase::class)->withTrashed();
    }

    protected $casts = [
        'colors' => 'array',
        'size' => 'array',
    ];
}
