<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->charset = "utf8";
            $table->collation="utf8_unicode_ci";
            $table->id();
            $table->char("_token",255);
            $table->string("car_name")->nullable();
            $table->integer("brand")->nullable();
            $table->integer("model")->nullable();
            $table->char("year",100)->nullable();
            $table->enum("engine",['1','2','3','4','5','6','7','8','9','10','11','12','13'])->nullable();
            $table->enum("type",['Sedan','Hackback'])->default('Sedan');
            $table->enum("power",['1','2','3','4','5','6'])->nullable();
            $table->enum("fuel",['Dizel','Benzin','Benzin + Gaz','Elektrikli']);
            $table->enum("transmission",['Oromatik','Manuel']);
            $table->integer("category")->nullable();
            $table->enum("doors",['1','2','3','4','5']);
            $table->enum("passenger",['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20']);
            $table->enum("big_luggage",['1','2','3','4','5','6','7','8','9','10']);
            $table->enum("small_luggage",['1','2','3','4','5','6','7','8','9','10']);
            $table->boolean("hydraulic_steering")->default(1);
            $table->boolean("4_wd")->default(1);
            $table->boolean("air_conditioner")->default(1);
            $table->boolean("ab")->default(1);
            $table->boolean("abs")->default(1);
            $table->boolean("radio")->default(1);
            $table->boolean("cd")->default(1);
            $table->boolean("sun_roof")->default(0);
            $table->boolean("is_active")->default(1);
            $table->integer("sort")->default(1);

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
        Schema::dropIfExists('cars');
    }
}
