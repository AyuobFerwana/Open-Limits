<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, Billable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'UsersName',
        'email',
        'password',
        'phone',
        'image',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Cart
    public function carts()
    {
        return $this->hasMany(Cart::class)->with('product');
    }

    
    public function checkouts()
    {
        return $this->hasMany(Checkout::class)->with('products');
    }
    
    // fULL name
    public function getFullNameAttribute()
    {
        return $this->UsersName;
    }

    // Image 
    public function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->image == null ? asset('ase/assets/img/avatars/blank-profile.png') : Storage::url($this->image)
        );
    }

}
