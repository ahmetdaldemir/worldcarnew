<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_operations', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger("id_reservation");
          $table->foreign('id_reservation')->references('id')->on('reservations')->onDelete('cascade');
          $table->enum('type',['up','drop'])->nullable();
          $table->string('km')->nullable();
          $table->string('fuel')->nullable();
          $table->json('files')->nullable();
          $table->softDeletes();
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
        Schema::dropIfExists('reservation_operations');
    }
}
