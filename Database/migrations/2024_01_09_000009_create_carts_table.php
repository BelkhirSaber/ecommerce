<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class {
    public function up() {
        if (!Capsule::schema()->hasTable('t_b3s_cart')) {
            Capsule::schema()->create('t_b3s_cart', function (Blueprint $table) {
                $table->increments('PK_CART');
                $table->unsignedInteger('FK_USER')->nullable();
                $table->string('SESSION_ID', 255)->nullable();
                $table->timestamp('CREATED_AT')->useCurrent();
                $table->timestamp('UPDATED_AT')->nullable()->useCurrentOnUpdate();
                
                $table->index('SESSION_ID', 'IDX_CART_SESSION');
                
                $table->foreign('FK_USER', 'FK_CART_USER')
                      ->references('PK_USER')
                      ->on('t_b3s_user')
                      ->onDelete('cascade');
            });
        }
    }
    
    public function down() {
        Capsule::schema()->dropIfExists('t_b3s_cart');
    }
};