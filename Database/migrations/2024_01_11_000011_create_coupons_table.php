<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class {
    public function up() {
        if (!Capsule::schema()->hasTable('t_b3s_coupon')) {
            Capsule::schema()->create('t_b3s_coupon', function (Blueprint $table) {
                $table->increments('PK_COUPON');
                $table->string('S_CODE', 50)->unique();
                $table->string('S_DESCRIPTION', 255)->nullable();
                $table->enum('E_TYPE', ['percentage', 'fixed']);
                $table->decimal('D_VALUE', 10, 2);
                $table->decimal('D_MIN_ORDER_AMOUNT', 10, 2)->default(0.00);
                $table->integer('I_MAX_USES')->nullable();
                $table->integer('I_CURRENT_USES')->default(0);
                $table->integer('I_MAX_USES_PER_USER')->default(1);
                $table->dateTime('DT_START_DATE');
                $table->dateTime('DT_END_DATE');
                $table->boolean('B_ACTIVE')->default(1);
                $table->timestamp('CREATED_AT')->useCurrent();
                $table->timestamp('UPDATED_AT')->nullable()->useCurrentOnUpdate();
            });
        }
    }
    
    public function down() {
        Capsule::schema()->dropIfExists('t_b3s_coupon');
    }
};