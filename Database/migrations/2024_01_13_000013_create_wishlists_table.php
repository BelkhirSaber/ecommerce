<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class {
    public function up() {
        if (!Capsule::schema()->hasTable('t_b3s_wishlist')) {
            Capsule::schema()->create('t_b3s_wishlist', function (Blueprint $table) {
                $table->increments('PK_WISHLIST');
                $table->unsignedInteger('FK_USER');
                $table->unsignedInteger('FK_PRODUCT');
                $table->timestamp('CREATED_AT')->useCurrent();
                
                $table->unique(['FK_USER', 'FK_PRODUCT'], 'UK_USER_PRODUCT');
                
                $table->foreign('FK_USER', 'FK_WISHLIST_USER')
                      ->references('PK_USER')
                      ->on('t_b3s_user')
                      ->onDelete('cascade');
                      
                $table->foreign('FK_PRODUCT', 'FK_WISHLIST_PRODUCT')
                      ->references('PK_PRODUCT')
                      ->on('t_b3s_product')
                      ->onDelete('cascade');
            });
        }
    }
    
    public function down() {
        Capsule::schema()->dropIfExists('t_b3s_wishlist');
    }
};