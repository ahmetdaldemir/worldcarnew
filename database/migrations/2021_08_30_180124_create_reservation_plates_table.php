<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationPlatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_plates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_reservation");
            $table->foreign('id_reservation')->references('id')->on('reservations')->onDelete('cascade');
            $table->unsignedBigInteger("id_plate");
            $table->foreign('id_plate')->references('id')->on('plates')->onDelete('cascade');
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
        Schema::dropIfExists('reservation_plates');
    }
}
