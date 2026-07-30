<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class User extends Model
{
    protected $table = 't_b3s_user';
    protected $primaryKey = 'PK_USER';
    
    const CREATED_AT = 'CREATED_AT';
    const UPDATED_AT = 'UPDATED_AT';

    protected $fillable = [
        'S_FIRSTNAME', 'S_LASTNAME', 'S_EMAIL', 'S_PASSWORD',
        'S_PHONE', 'E_ROLE', 'B_ACTIVE'
    ];

    protected $hidden = ['S_PASSWORD'];

    public function orders()
    {
        return $this->hasMany(Order::class, 'FK_CUSTOMER', 'PK_USER');
    }

    public function addresses()
    {
        return $this->hasMany(Address::class, 'FK_USER', 'PK_USER');
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class, 'FK_USER', 'PK_USER');
    }

    public function scopeLast30Days($query)
    {
        return $query->where('CREATED_AT', '>=', Carbon::now()->subDays(30));
    }
}