<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class {
    public function up() {
        if (!Capsule::schema()->hasTable('t_b3s_product_variant')) {
            Capsule::schema()->create('t_b3s_product_variant', function (Blueprint $table) {
                $table->increments('PK_PRODUCT_VARIANT');
                $table->unsignedInteger('FK_PRODUCT');
                $table->string('SKU', 100);
                $table->decimal('PRICE', 10, 2);
                $table->integer('DISCOUNT')->default(0);
                $table->integer('STOCK')->default(0);
                $table->string('IMAGE', 255)->nullable();
                $table->boolean('ACTIVE')->default(1);
                $table->timestamp('CREATED_AT')->useCurrent();
                $table->timestamp('UPDATED_AT')->nullable()->useCurrentOnUpdate();
                
                $table->index('FK_PRODUCT', 'IDX_VARIANT_PRODUCT');
                
                $table->foreign('FK_PRODUCT', 'FK_VARIANT_PRODUCT')
                      ->references('PK_PRODUCT')
                      ->on('t_b3s_product')
                      ->onDelete('cascade');
            });
        }
    }
    
    public function down() {
        Capsule::schema()->dropIfExists('t_b3s_product_variant');
    }
};