<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationEkstrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_ekstras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_reservation");
            $table->foreign('id_reservation')->references('id')->on('reservations')->onDelete('cascade');
            $table->unsignedBigInteger("id_ekstra");
            $table->foreign('id_ekstra')->references('id')->on('ekstras')->onDelete('cascade');
            $table->integer("day");
            $table->integer("item");
            $table->double("item_price",10,2);
            $table->double("price",10,2);
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
        Schema::dropIfExists('reservation_ekstras');
    }
}
