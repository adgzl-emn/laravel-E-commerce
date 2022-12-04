<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sepet_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sepet_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('adet');
            $table->decimal('fiyat');
            $table->string('durum',30);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('sepet_id')
                ->references('id')
                ->on('sepets')
                ->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sepet_products');
    }
};
