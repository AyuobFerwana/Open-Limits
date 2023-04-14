<?php

namespace App\Models;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;


    protected $products = 'products';


    public function purchases()
    {
        return $this->hasMany(Purchase::class)->withTrashed();
    }


    public function category()
    {
        return $this->belongsTo(Category::class)->withTrashed();
    }

    protected $casts = [
        'colors' => 'array',
        'size' => 'array',
    ];

    public function checkouts()
    {
        return $this->belongsToMany(Checkout::class)->withPivot('quantity');
    }
}
