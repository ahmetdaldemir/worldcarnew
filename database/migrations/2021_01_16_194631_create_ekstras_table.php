<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEkstrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ekstras', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->char("_token",255);
            $table->double("price",10,2);
            $table->enum("mandatoryInContract",['yes','no'])->default("yes");
            $table->enum("itemOfCustom",['yes','no'])->default("yes");
            $table->enum("type",['insurance','ekstra'])->default("insurance");
            $table->enum("sellType",['daily','ofRent'])->default("daily");
            $table->boolean("status")->default(1);
            $table->timestamps();
        });
        Schema::create('ekstra_languages', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('id_ekstra');
            $table->foreign('id_ekstra')->references('id')->on('ekstras')->onDelete('cascade');
            $table->unsignedBigInteger('id_lang')->nullable();
            $table->foreign('id_lang')->references('id')->on('languages')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('info')->nullable();
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
        Schema::dropIfExists('ekstras');
    }
}
