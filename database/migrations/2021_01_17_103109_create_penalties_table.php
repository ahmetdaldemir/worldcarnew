<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenaltiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penalties', function (Blueprint $table) {
            $table->id();
            $table->integer('id_plate');
            $table->integer('id_reservation');
            $table->char('code',5);
            $table->char('serial',50)->nullable();
            $table->char('value',255)->nullable();
            $table->char('location',255)->nullable();
            $table->char('department',255)->nullable();
            $table->text('description')->nullable();
            $table->date('penalyty_date')->nullable();
            $table->date('manifesto_date')->nullable();
            $table->double('price',10,2)->nullable();
            $table->double('fee',10,2)->nullable();
            $table->boolean('payment_status')->default(0);
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
        Schema::dropIfExists('penalties');
    }
}
