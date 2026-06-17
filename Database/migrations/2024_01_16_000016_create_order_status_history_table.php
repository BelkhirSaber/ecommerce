<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class {
    public function up() {
        if (!Capsule::schema()->hasTable('t_b3s_order_status_history')) {
            Capsule::schema()->create('t_b3s_order_status_history', function (Blueprint $table) {
                $table->increments('PK_STATUS_HISTORY');
                $table->unsignedInteger('FK_ORDER');
                $table->enum('E_OLD_STATUS', ['pending', 'processing', 'paid', 'shipped', 'delivered', 'cancelled', 'refunded'])->nullable();
                $table->enum('E_NEW_STATUS', ['pending', 'processing', 'paid', 'shipped', 'delivered', 'cancelled', 'refunded']);
                $table->text('T_COMMENT')->nullable();
                $table->unsignedInteger('FK_UPDATED_BY')->nullable();
                $table->timestamp('CREATED_AT')->useCurrent();
                
                $table->foreign('FK_ORDER')->references('PK_ORDER')->on('t_b3s_order')->onDelete('cascade');
                $table->foreign('FK_UPDATED_BY')->references('PK_USER')->on('t_b3s_user')->onDelete('set null');
            });
        }
    }
    
    public function down() {
        Capsule::schema()->dropIfExists('t_b3s_order_status_history');
    }
};