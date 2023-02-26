<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string('module');
            $table->integer('id_module');

            $table->boolean("status")->default();
            $table->enum("default",["default","normal"])->default("normal");
            $table->integer("sort")->default("0");
            $table->integer("position")->nullable();

            $table->string('model');
            $table->integer('model_id');
            $table->string('title');
            $table->string('alt');
            $table->string('platfom');
            $table->string('pixel');
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
        Schema::dropIfExists('images');
    }
}
