<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model {

  public $timestamps = false;

  protected $table = "t_b3s_attribute_value";

  protected $primaryKey = "PK_ATTRIBUTE_VALUE";

  protected $fillable = [
      'FK_ATTRIBUTE',
      'VALUE'
  ];

  public function attribute()
  {
      return $this->belongsTo(Attribute::class, 'FK_ATTRIBUTE', 'PK_ATTRIBUTE');
  }

  public function productVariant()
  {
      return $this->belongsToMany(
        ProductVariant::class,
        't_b3s_product_variant_attribute', 
        'FK_ATTRIBUTE_VALUE', 
        'FK_PRODUCT_VARIANT'
        );
  }

}