<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class {
    public function up() {
        if (!Capsule::schema()->hasTable('t_b3s_product_variant_attribute')) {
            Capsule::schema()->create('t_b3s_product_variant_attribute', function (Blueprint $table) {
                $table->increments('PK_PRODUCT_VARIANT_ATTRIBUTE');
                $table->unsignedInteger('FK_PRODUCT_VARIANT');
                $table->unsignedInteger('FK_ATTRIBUTE_VALUE');
                
                $table->unique(['FK_PRODUCT_VARIANT', 'FK_ATTRIBUTE_VALUE'], 'UK_VARIANT_ATTR');
                
                $table->foreign('FK_PRODUCT_VARIANT', 'FK_VARIANT_ATTR_VARIANT')
                      ->references('PK_PRODUCT_VARIANT')
                      ->on('t_b3s_product_variant')
                      ->onDelete('cascade');
                      
                $table->foreign('FK_ATTRIBUTE_VALUE', 'FK_VARIANT_ATTR_VALUE')
                      ->references('PK_ATTRIBUTE_VALUE')
                      ->on('t_b3s_attribute_value')
                      ->onDelete('cascade');
            });
        }
    }
    
    public function down() {
        Capsule::schema()->dropIfExists('t_b3s_product_variant_attribute');
    }
};
