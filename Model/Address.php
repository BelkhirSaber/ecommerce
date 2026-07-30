<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 't_b3s_address';
    protected $primaryKey = 'PK_ADDRESS';
    
    const CREATED_AT = 'CREATED_AT';
    const UPDATED_AT = 'UPDATED_AT';

    protected $fillable = [
        'FK_USER',
        'S_LABEL',
        'S_FIRSTNAME',
        'S_LASTNAME',
        'S_ADDRESS_LINE1',
        'S_ADDRESS_LINE2',
        'S_CITY',
        'S_POSTAL_CODE',
        'S_COUNTRY',
        'S_PHONE',
        'B_IS_DEFAULT',
        'E_TYPE'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'FK_USER', 'PK_USER');
    }
}