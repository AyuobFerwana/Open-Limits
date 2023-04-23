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
    protected $guarded = [];


    public function category()
    {
        return $this->belongsTo(Category::class)->withTrashed();
    }

    public function checkouts()
    {
        return $this->belongsToMany(Checkout::class)->withPivot('quantity');
    }
    protected $casts = [
        'colors' => 'array',
        'size' => 'array',
    ];

}
