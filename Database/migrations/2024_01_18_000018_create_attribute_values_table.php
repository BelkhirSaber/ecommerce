<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class {
    public function up() {
        if (!Capsule::schema()->hasTable('t_b3s_attribute_value')) {
            Capsule::schema()->create('t_b3s_attribute_value', function (Blueprint $table) {
                $table->increments('PK_ATTRIBUTE_VALUE');
                $table->unsignedInteger('FK_ATTRIBUTE');
                $table->string('VALUE', 100);
                
                $table->index('FK_ATTRIBUTE', 'IDX_ATTRIBUTE_VALUE_ATTRIBUTE');
                
                $table->foreign('FK_ATTRIBUTE', 'FK_ATTRIBUTE_VALUE_ATTRIBUTE')
                      ->references('PK_ATTRIBUTE')
                      ->on('t_b3s_attribute')
                      ->onDelete('cascade');
            });
        }
    }
    
    public function down() {
        Capsule::schema()->dropIfExists('t_b3s_attribute_value');
    }
};
