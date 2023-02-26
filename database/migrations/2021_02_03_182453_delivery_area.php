<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeliveryArea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_area', function (Blueprint $table) {
            $table->id();
            $table->integer("id_location");
            $table->timestamps();
        });

        Schema::create('delivery_area_language', function (Blueprint $table) {
            $table->id();
            $table->integer("id_delivery_area");
            $table->integer("id_lang");
            $table->char("title",100);
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
        //
    }
}
