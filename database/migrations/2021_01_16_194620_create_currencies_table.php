<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string("title",100);
            $table->string("left_icon",3)->nullable();
            $table->string("right_icon",3)->nullable();
            $table->string("decimal_place")->nullable();
            $table->char("default",10)->default('1');
            $table->float("price_buy",10,2)->default(0);
            $table->float("price_sell",10,2)->default(0);
            $table->boolean("status")->default(1);
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
        Schema::dropIfExists('currencies');
    }
}
