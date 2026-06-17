<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class {
    public function up() {
        if (!Capsule::schema()->hasTable('t_b3s_category')) {
            Capsule::schema()->create('t_b3s_category', function (Blueprint $table) {
                $table->increments('PK_CATEGORY');
                $table->unsignedInteger('FK_PARENT_CATEGORY')->nullable();
                $table->string('S_NAME', 100);
                $table->string('S_SLUG', 120)->unique();
                $table->text('S_DESCRIPTION')->nullable();
                $table->integer('I_ORDER')->default(0);
                $table->boolean('B_ACTIVE')->default(1);
                $table->timestamp('CREATED_AT')->useCurrent();
                $table->timestamp('UPDATED_AT')->nullable()->useCurrentOnUpdate();
                
                $table->foreign('FK_PARENT_CATEGORY')
                      ->references('PK_CATEGORY')
                      ->on('t_b3s_category')
                      ->onDelete('set null');
            });
        }
    }
    
    public function down() {
        Capsule::schema()->dropIfExists('t_b3s_category');
    }
};