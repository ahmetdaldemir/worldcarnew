<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campings', function (Blueprint $table) {
            $table->id();
            $table->char("title");
            $table->integer("id_car");
            $table->double("pricer1",10,2);
            $table->double("pricer2",10,2);
            $table->double("pricer3",10,2);
            $table->double("pricer4",10,2);
            $table->integer("id_currency");
            $table->date("start_date");
            $table->date("finish_date");
            $table->integer("period_validity");
            $table->integer("customer_type");
            $table->boolean("status")->default();
            $table->enum("location",["domestic","abroad"]);
            $table->jsonb("destination");
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
        Schema::dropIfExists('campings');
    }
}
