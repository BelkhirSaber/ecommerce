<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class {
    public function up() {
        if (!Capsule::schema()->hasTable('t_b3s_coupon_usage')) {
            Capsule::schema()->create('t_b3s_coupon_usage', function (Blueprint $table) {
                $table->increments('PK_COUPON_USAGE');
                $table->unsignedInteger('FK_COUPON');
                $table->unsignedInteger('FK_USER');
                $table->unsignedInteger('FK_ORDER');
                $table->timestamp('CREATED_AT')->useCurrent();
                
                $table->foreign('FK_COUPON')->references('PK_COUPON')->on('t_b3s_coupon')->onDelete('cascade');
                $table->foreign('FK_USER')->references('PK_USER')->on('t_b3s_user')->onDelete('cascade');
                $table->foreign('FK_ORDER')->references('PK_ORDER')->on('t_b3s_order')->onDelete('cascade');
            });
        }
    }
    
    public function down() {
        Capsule::schema()->dropIfExists('t_b3s_coupon_usage');
    }
};