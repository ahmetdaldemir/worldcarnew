<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_reports', function (Blueprint $table) {
            $table->id();
            $table->integer('language_id');
            $table->string('ip');
            $table->json('search')->nullable();
            $table->string('referer');
            $table->string('modelname');
            $table->string('country');
            $table->string('platform');
            $table->string('token');
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
        Schema::dropIfExists('access_reports');
    }
}
