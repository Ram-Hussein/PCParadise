<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'fname',
        'lname',
        'email',
        'password',
        'country_id',
        'date_of_birth',
        'PhoneNumber',
        'is_admin',
    ];

    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
    public function cartitems(){
        return $this->hasMany(CartItem::class);
    }
    public function favourites(){
        return $this->hasMany(Favourite::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'is_admin',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
