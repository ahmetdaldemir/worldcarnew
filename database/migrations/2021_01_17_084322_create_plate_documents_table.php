<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plate_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_plate",100);
            $table->foreign('id_plate')->references('id')->on('plates')->onDelete('cascade');
            $table->date("insurance_start");
            $table->date("insurance_finish");
            $table->char("insurance_company",100);
            $table->enum("type",['kasko','sigorta','rent_a_car_sigortasi','muayene','eksoz_muayenesi']);
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
        Schema::dropIfExists('plate_documents');
    }
}
