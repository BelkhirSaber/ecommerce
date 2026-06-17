<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class {
    public function up() {
        if (!Capsule::schema()->hasTable('t_b3s_order_item')) {
            Capsule::schema()->create('t_b3s_order_item', function (Blueprint $table) {
                $table->increments('PK_ORDER_ITEM');
                $table->unsignedInteger('FK_ORDER');
                $table->unsignedInteger('FK_PRODUCT');
                $table->unsignedInteger('FK_PRODUCT_VARIANT')->nullable();
                $table->string('PRODUCT_TITLE', 255);
                $table->string('PRODUCT_SKU', 100)->nullable();
                $table->decimal('UNIT_PRICE', 10, 2);
                $table->integer('QUANTITY')->default(1);
                $table->decimal('LINE_TOTAL', 10, 2);
                $table->timestamp('CREATED_AT')->useCurrent();
                
                $table->index('FK_ORDER', 'IDX_ORDER_ITEM_ORDER');
                
                $table->foreign('FK_ORDER', 'FK_ORDER_ITEM_ORDER')
                      ->references('PK_ORDER')
                      ->on('t_b3s_order')
                      ->onDelete('cascade');
                      
                $table->foreign('FK_PRODUCT', 'FK_ORDER_ITEM_PRODUCT')
                      ->references('PK_PRODUCT')
                      ->on('t_b3s_product')
                      ->onDelete('restrict');
                      
                $table->foreign('FK_PRODUCT_VARIANT', 'FK_ORDER_ITEM_VARIANT')
                      ->references('PK_PRODUCT_VARIANT')
                      ->on('t_b3s_product_variant')
                      ->onDelete('set null');
            });
        }
    }
    
    public function down() {
        Capsule::schema()->dropIfExists('t_b3s_order_item');
    }
};