<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model {


  public $timestamps = false;

  protected $table = "t_b3s_attribute";

  protected $primaryKey = "PK_ATTRIBUTE";

  protected $fillable = [
      'NAME'
  ];

  public function attributeValues()
  {
      return $this->hasMany(AttributeValue::class, 'FK_ATTRIBUTE', 'PK_ATTRIBUTE');
  }



}