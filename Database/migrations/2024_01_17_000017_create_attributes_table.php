<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class {
    public function up() {
        if (!Capsule::schema()->hasTable('t_b3s_attribute')) {
            Capsule::schema()->create('t_b3s_attribute', function (Blueprint $table) {
                $table->increments('PK_ATTRIBUTE');
                $table->string('NAME', 100);
            });
        }
    }
    
    public function down() {
        Capsule::schema()->dropIfExists('t_b3s_attribute');
    }
};
