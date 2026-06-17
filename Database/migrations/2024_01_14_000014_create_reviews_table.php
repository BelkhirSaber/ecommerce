<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class {
    public function up() {
        if (!Capsule::schema()->hasTable('t_b3s_product_review')) {
            Capsule::schema()->create('t_b3s_product_review', function (Blueprint $table) {
                $table->increments('PK_PRODUCT_REVIEW');
                $table->unsignedInteger('FK_PRODUCT');
                $table->unsignedInteger('FK_CUSTOMER');
                $table->tinyInteger('RATING');
                $table->string('TITLE', 255)->nullable();
                $table->text('COMMENT')->nullable();
                $table->timestamp('CREATED_AT')->useCurrent();
                
                $table->index('FK_PRODUCT', 'IDX_PRODUCT_REVIEW_PRODUCT');
                
                $table->foreign('FK_PRODUCT', 'FK_PRODUCT_REVIEW_PRODUCT')
                      ->references('PK_PRODUCT')
                      ->on('t_b3s_product')
                      ->onDelete('cascade');
                      
                $table->foreign('FK_CUSTOMER', 'FK_PRODUCT_REVIEW_CUSTOMER')
                      ->references('PK_USER')
                      ->on('t_b3s_user')
                      ->onDelete('cascade');
            });
        }
    }
    
    public function down() {
        Capsule::schema()->dropIfExists('t_b3s_product_review');
    }
};
