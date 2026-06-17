<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class {
    public function up() {
        if (!Capsule::schema()->hasTable('t_b3s_user')) {
            Capsule::schema()->create('t_b3s_user', function (Blueprint $table) {
                $table->increments('PK_USER');
                $table->string('S_FIRSTNAME', 25);
                $table->string('S_LASTNAME', 25);
                $table->string('S_EMAIL', 50)->unique();
                $table->string('S_PASSWORD', 255);
                $table->string('S_PHONE', 20)->nullable();
                $table->enum('E_ROLE', ['customer', 'admin', 'manager'])->default('customer');
                $table->boolean('B_ACTIVE')->default(1);
                $table->string('S_RESET_TOKEN', 100)->nullable();
                $table->dateTime('DT_RESET_EXPIRES')->nullable();
                $table->timestamp('CREATED_AT')->useCurrent();
                $table->timestamp('UPDATED_AT')->nullable()->useCurrentOnUpdate();
            });
        }
    }
    
    public function down() {
        Capsule::schema()->dropIfExists('t_b3s_user');
    }
};