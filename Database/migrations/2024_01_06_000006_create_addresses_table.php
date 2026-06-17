<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class {
    public function up() {
        if (!Capsule::schema()->hasTable('t_b3s_address')) {
            Capsule::schema()->create('t_b3s_address', function (Blueprint $table) {
                $table->increments('PK_ADDRESS');
                $table->unsignedInteger('FK_USER');
                $table->string('S_LABEL', 50)->nullable();
                $table->string('S_FIRSTNAME', 50);
                $table->string('S_LASTNAME', 50);
                $table->string('S_ADDRESS_LINE1', 255);
                $table->string('S_ADDRESS_LINE2', 255)->nullable();
                $table->string('S_CITY', 100);
                $table->string('S_POSTAL_CODE', 20);
                $table->string('S_COUNTRY', 100);
                $table->string('S_PHONE', 20)->nullable();
                $table->boolean('B_IS_DEFAULT')->default(0);
                $table->enum('E_TYPE', ['billing', 'shipping', 'both'])->default('both');
                $table->timestamp('CREATED_AT')->useCurrent();
                $table->timestamp('UPDATED_AT')->nullable()->useCurrentOnUpdate();
                
                $table->foreign('FK_USER')
                      ->references('PK_USER')
                      ->on('t_b3s_user')
                      ->onDelete('cascade');
            });
        }
    }
    
    public function down() {
        Capsule::schema()->dropIfExists('t_b3s_address');
    }
};