<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriodPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('period_prices', function (Blueprint $table) {
            $table->id();
            $table->char("_token");
            $table->integer("id_car");
            $table->integer("mounth");
            $table->integer("id_location");
            $table->double("period1",10,2);
            $table->double("period2",10,2);
            $table->double("period3",10,2);
            $table->double("period4",10,2);
            $table->double("period5",10,2);
            $table->double("period6",10,2);
            $table->double("period7",10,2);
            $table->double("discount",10,2);
            $table->boolean("status")->default(true);
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
        Schema::dropIfExists('period_prices');
    }
}
