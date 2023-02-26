<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationRestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_rests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_reservation");
            $table->unsignedBigInteger("currency");
            $table->foreign('currency')->references('id')->on('currencies')->onDelete('cascade');
            $table->foreign('id_reservation')->references('id')->on('reservations')->onDelete('cascade');
            $table->text("note")->nullable();
            $table->double("price",10,2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation_rests');
    }
}
