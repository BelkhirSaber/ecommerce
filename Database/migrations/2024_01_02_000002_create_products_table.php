<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class {
    public function up() {
        if (!Capsule::schema()->hasTable('t_b3s_product')) {
            Capsule::schema()->create('t_b3s_product', function (Blueprint $table) {
                $table->increments('PK_PRODUCT');
                $table->unsignedInteger('FK_CATEGORY');
                $table->string('SLUG', 255)->unique();
                $table->string('TITLE', 255);
                $table->string('SHORT_DESCRIPTION', 255);
                $table->boolean('IN_STOCK')->default(1);
                $table->boolean('SHOW_IN_STORE')->default(1);
                $table->timestamp('CREATED_AT')->useCurrent();
                $table->timestamp('UPDATED_AT')->nullable()->useCurrentOnUpdate();
                
                $table->index('FK_CATEGORY', 'IDX_PRODUCT_CATEGORY');
                
                $table->foreign('FK_CATEGORY', 'FK_PRODUCT_CATEGORY')
                      ->references('PK_CATEGORY')
                      ->on('t_b3s_category')
                      ->onDelete('restrict');
            });
        }
    }
    
    public function down() {
        Capsule::schema()->dropIfExists('t_b3s_product');
    }
};