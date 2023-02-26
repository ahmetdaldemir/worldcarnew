<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinationLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destination_languages', function (Blueprint $table) {
            $table->id();
            $table->integer("id_destination")->nullable();
            $table->integer("id_lang")->nullable();
            $table->string("title")->nullable();
            $table->string("short_description",255)->nullable();
            $table->text("description")->nullable();
            $table->string("meta_title")->nullable();
            $table->string("slug");
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
        Schema::dropIfExists('destination_languages');
    }
}
