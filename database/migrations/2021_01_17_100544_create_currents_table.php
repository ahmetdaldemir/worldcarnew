<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currents', function (Blueprint $table) {
            $table->id();
            $table->integer("id_category");
            $table->char("code",5);
            $table->char("firstname",255);
            $table->char("lastname",255);
            $table->text("address",255);
            $table->char("phone",255);
            $table->char("email",255);
            $table->char("tax",255)->nullable();
            $table->char("tax_office",255)->nullable();
            $table->char("iban",255)->nullable();
            $table->char("bank_name",255)->nullable();
            $table->char("account_no",255)->nullable();
            $table->char("substation",255)->nullable();
            $table->char("substation_code",255)->nullable();
            $table->char("cc_number",255)->nullable();
            $table->char("cc_mounth",2)->nullable();
            $table->char("cc_year",2)->nullable();
            $table->char("ccv",4)->nullable();
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
        Schema::dropIfExists('currents');
    }
}
