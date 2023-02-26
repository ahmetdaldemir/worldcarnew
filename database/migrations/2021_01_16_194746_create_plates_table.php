<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plates', function (Blueprint $table) {
            $table->id();
            $table->char("id_car",100)->nullable();
            $table->char("plate",100)->nullable();
            $table->date("registry",100)->nullable();
            $table->char("km",100)->nullable();
            $table->char("oil_km",100)->nullable();
            $table->text("description")->nullable();
            $table->enum("status",['10','20','30','40','50'])->default('40');
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
        Schema::dropIfExists('plates');
    }
}
