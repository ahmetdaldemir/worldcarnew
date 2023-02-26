<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->integer("id_parent");
            $table->integer("sort")->default(1000000);
            $table->enum("type",['hotel','airport','center'])->default('center');
            $table->boolean("status")->default(1);
            $table->boolean("return_status")->default(0);
            $table->double("price",10,2)->default(0);
            $table->string("return_distance")->default(0);
            $table->double("return_price",10,2)->default(0);
            $table->integer("min_day")->default(0)->nullable();
            $table->double("drop_price",10,2)->default(0)->nullable();
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
        Schema::dropIfExists('locations');
    }
}
