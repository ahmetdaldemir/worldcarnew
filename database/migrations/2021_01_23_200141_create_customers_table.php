<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->char("firstname")->nullable();
            $table->char("lastname")->nullable();
            $table->char("email")->nullable();
            $table->char("phone")->nullable();
            $table->char("phone1")->nullable();
            $table->enum("gender",['men','woman'])->nullable();
            $table->char("birthday")->nullable();
            $table->char("nationality")->nullable();
            $table->string("password")->nullable();
            $table->string("google_id")->nullable();
            $table->string("tc")->nullable();
            $table->string("birthpalace")->nullable();
            $table->string("language")->nullable();
            $table->string("tax_office")->nullable();
            $table->string("tax")->nullable();
            $table->string("identity_no")->nullable();
            $table->enum("identity_type",['identity','passport'])->nullable();
            $table->string("passport_palace")->nullable();
            $table->string("passport_date")->nullable();
            $table->string("phone_country")->nullable();
            $table->string("home_address")->nullable();
            $table->string("point")->default(0);
            $table->string("remaining_points")->default(0);
            $table->string("office_address")->nullable();
            $table->string("driving_licance_number")->nullable();
            $table->string("driving_licance_class")->nullable();
            $table->string("driving_licance_location")->nullable();
            $table->string("driving_licance_date")->nullable();
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
        Schema::dropIfExists('customers');
    }
}
