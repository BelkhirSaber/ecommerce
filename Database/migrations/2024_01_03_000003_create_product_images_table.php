<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class {
    public function up() {
        if (!Capsule::schema()->hasTable('t_b3s_product_image')) {
            Capsule::schema()->create('t_b3s_product_image', function (Blueprint $table) {
                $table->increments('PK_PRODUCT_IMAGE');
                $table->unsignedInteger('FK_PRODUCT');
                $table->string('IMAGE', 255);
                $table->integer('POSITION')->default(0);
                
                $table->index('FK_PRODUCT', 'IDX_PRODUCT_IMAGE_PRODUCT');
                
                $table->foreign('FK_PRODUCT', 'FK_PRODUCT_IMAGE_PRODUCT')
                      ->references('PK_PRODUCT')
                      ->on('t_b3s_product')
                      ->onDelete('cascade');
            });
        }
    }
    
    public function down() {
        Capsule::schema()->dropIfExists('t_b3s_product_image');
    }
};