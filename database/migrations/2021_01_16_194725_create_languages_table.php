<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->char("title",100);
            $table->char("short",2)->nullable();;
            $table->char("flag",100)->nullable();
            $table->boolean("status")->default(1);
            $table->boolean("view")->default(0);
            $table->integer("sort")->default(0);
            $table->string("meta_title")->nullable();
            $table->string("alt_text")->nullable();
            $table->string("href_text")->nullable();
            $table->text("meta_description")->nullable();
            $table->text("subject_birthday")->nullable();
            $table->text("subject_survey")->nullable();
            $table->text("subject_reservation")->nullable();
            $table->char("url",2)->default("tr");
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
        Schema::dropIfExists('languages');
    }
}
