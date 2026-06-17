<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class {
    public function up() {
        if (!Capsule::schema()->hasTable('t_b3s_cart_item')) {
            Capsule::schema()->create('t_b3s_cart_item', function (Blueprint $table) {
                $table->increments('PK_CART_ITEM');
                $table->unsignedInteger('FK_CART');
                $table->unsignedInteger('FK_PRODUCT');
                $table->unsignedInteger('FK_PRODUCT_VARIANT')->nullable();
                $table->integer('QUANTITY')->default(1);
                $table->timestamp('CREATED_AT')->useCurrent();
                $table->timestamp('UPDATED_AT')->nullable()->useCurrentOnUpdate();
                
                $table->foreign('FK_CART', 'FK_CART_ITEM_CART')
                      ->references('PK_CART')
                      ->on('t_b3s_cart')
                      ->onDelete('cascade');
                      
                $table->foreign('FK_PRODUCT', 'FK_CART_ITEM_PRODUCT')
                      ->references('PK_PRODUCT')
                      ->on('t_b3s_product')
                      ->onDelete('cascade');
                      
                $table->foreign('FK_PRODUCT_VARIANT', 'FK_CART_ITEM_VARIANT')
                      ->references('PK_PRODUCT_VARIANT')
                      ->on('t_b3s_product_variant')
                      ->onDelete('set null');
            });
        }
    }
    
    public function down() {
        Capsule::schema()->dropIfExists('t_b3s_cart_item');
    }
};