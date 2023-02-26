<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferZoneFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_zone_fees', function (Blueprint $table) {
            $table->id();
            $table->integer("id_location");
            $table->integer("id_location_transfer_zone")->nullable();
            $table->integer("distance")->nullable();
            $table->double("price",10,2);
            $table->char("status")->default("on");
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
        Schema::dropIfExists('transfer_zone_fees');
    }
}
