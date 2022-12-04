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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sepet_id');
            $table->decimal('siparis_tutari');  //string tut
            //$table->bigInteger('spk');
            $table->string('durum')->nullable();
            $table->string('banka')->nullable();
            $table->integer('taksit_sayisi')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('sepet_id')
                ->references('id')
                ->on('sepets')
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
        Schema::dropIfExists('orders');
    }
};
