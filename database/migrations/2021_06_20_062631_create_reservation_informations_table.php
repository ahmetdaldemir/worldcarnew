<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_reservation");
            $table->foreign('id_reservation')->references('id')->on('reservations')->onDelete('cascade')->onUpdate('cascade');
            $table->date("checkin");
            $table->date("checkout");
            $table->time("checkin_time");
            $table->time("checkout_time");
            $table->integer("days");
            $table->integer("up_location");
            $table->integer("drop_location");
            $table->json("up_drop_information");
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
        Schema::dropIfExists('reservation_informations');
    }
}
