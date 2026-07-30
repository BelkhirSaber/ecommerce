<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;


class Category extends Model {
    protected $table = 't_b3s_category';
    protected $primaryKey = 'PK_CATEGORY';
    
    const CREATED_AT = 'CREATED_AT';
    const UPDATED_AT = 'UPDATED_AT';

    protected $fillable = [
        'FK_PARENT_CATEGORY',
        'S_NAME',
        'S_SLUG',
        'S_DESCRIPTION',
        'I_ORDER',
        'B_ACTIVE'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'FK_CATEGORY', 'PK_CATEGORY');
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'FK_PARENT_CATEGORY', 'PK_CATEGORY');
    }



}