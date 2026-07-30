<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class {
    public function up() {
        if (!Capsule::schema()->hasTable('t_b3s_order')) {
            Capsule::schema()->create('t_b3s_order', function (Blueprint $table) {
                $table->increments('PK_ORDER');
                $table->unsignedInteger('FK_USER');
                $table->string('ORDER_NUMBER', 50)->unique();
                $table->enum('STATUS', ['pending', 'paid', 'processing', 'shipped', 'delivered', 'cancelled', 'refunded'])->default('pending');
                $table->decimal('SUBTOTAL', 10, 2)->default(0.00);
                $table->decimal('DISCOUNT_AMOUNT', 10, 2)->default(0.00);
                $table->decimal('SHIPPING_AMOUNT', 10, 2)->default(0.00);
                $table->decimal('TOTAL_AMOUNT', 10, 2)->default(0.00);
                $table->string('USER_NAME', 255);
                $table->string('USER_EMAIL', 255);
                $table->text('SHIPPING_ADDRESS')->nullable();
                $table->timestamp('CREATED_AT')->useCurrent();
                $table->timestamp('UPDATED_AT')->nullable()->useCurrentOnUpdate();
                
                $table->unique('ORDER_NUMBER', 'UK_ORDER_NUMBER');
                $table->index('FK_USER', 'IDX_ORDER_USER');
                
                $table->foreign('FK_USER', 'FK_ORDER_USER')
                      ->references('PK_USER')
                      ->on('t_b3s_user')
                      ->onDelete('restrict');
            });
        }
    }
    
    public function down() {
        Capsule::schema()->dropIfExists('t_b3s_order');
    }
};