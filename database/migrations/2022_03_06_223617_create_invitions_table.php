<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('receiver_name');
            $table->string('receiver_mail');
            $table->string('receiver_code');
            $table->string('receiver_percent')->default(10);
            $table->smallInteger('status')->default(0);
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
        Schema::dropIfExists('invitions');
    }
}
