<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class {
    public function up() {
        if (!Capsule::schema()->hasTable('t_b3s_shipping_method')) {
            Capsule::schema()->create('t_b3s_shipping_method', function (Blueprint $table) {
                $table->increments('PK_SHIPPING_METHOD');
                $table->string('S_NAME', 100);
                $table->text('S_DESCRIPTION')->nullable();
                $table->decimal('D_PRICE', 10, 2);
                $table->decimal('D_FREE_SHIPPING_THRESHOLD', 10, 2)->nullable();
                $table->integer('I_ESTIMATED_DAYS_MIN')->nullable();
                $table->integer('I_ESTIMATED_DAYS_MAX')->nullable();
                $table->boolean('B_ACTIVE')->default(1);
                $table->timestamp('CREATED_AT')->useCurrent();
                $table->timestamp('UPDATED_AT')->nullable()->useCurrentOnUpdate();
            });
        }
    }
    
    public function down() {
        Capsule::schema()->dropIfExists('t_b3s_shipping_method');
    }
};