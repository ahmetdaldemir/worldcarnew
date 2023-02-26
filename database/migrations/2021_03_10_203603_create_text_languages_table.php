<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTextLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('text_languages', function (Blueprint $table) {
            $table->id();
            $table->integer("id_text")->nullable();
            $table->integer("id_lang")->nullable();
            $table->char("title")->nullable();
            $table->char("meta_title")->nullable();
            $table->text("description")->nullable();
            $table->string("slug")->nullable();
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
        Schema::dropIfExists('text_languages');
    }
}
