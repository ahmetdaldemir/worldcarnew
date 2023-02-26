<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_customer");
            $table->foreign('id_customer')->references('id')->on('customers')->onDelete('cascade');
            $table->boolean("status")->default(0);
            $table->string("subject")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('ticket_contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_user")->nullable();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger("id_ticket");
            $table->foreign('id_ticket')->references('id')->on('tickets')->onDelete('cascade');
            $table->text("message");
            $table->boolean("answer")->default(0);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
        Schema::dropIfExists('ticket_content');
    }
}
