<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_customer");
            $table->foreign('id_customer')->references('id')->on('customers')->onDelete('cascade');
            $table->string("phone");
            $table->string("phone2");
            $table->date("birthday");
            $table->smallInteger("driver_license");
            $table->unsignedBigInteger("id_language");
            $table->foreign('id_language')->references('id')->on('languages')->onDelete('cascade');
            $table->string("nationality");
            $table->enum("payment_method", ['debit-card', 'delivery-debit-card', 'debit-cash', 'online-credit-card']);
            $table->double("total_amount", 10, 2);
            $table->unsignedBigInteger("id_currency")->default(1);
            $table->foreign('id_currency')->references('id')->on('currencies')->onDelete('cascade');
            $table->boolean("sms_send")->default(0);
            $table->string("email_send")->nullable();
            $table->date("comfirm_date")->nullable();
            $table->integer("car")->nullable();
            $table->unsignedBigInteger("up_location")->index();
            $table->foreign('up_location')->references('id')->on('locations')->onDelete('cascade');
            $table->unsignedBigInteger("drop_location")->index();
            $table->foreign('drop_location')->references('id')->on('locations')->onDelete('cascade');
            $table->double("day_price", 10, 2)->nullable();
            $table->double("drop_price", 10, 2)->nullable();
            $table->double("up_price", 10, 2)->nullable();
            $table->double("ekstra_price", 10, 2)->nullable();
            $table->double("discount", 10, 2)->nullable();
            $table->double("coupon", 10, 2)->nullable();
            $table->double("rent_price", 10, 2)->nullable();
            $table->integer("days")->nullable();
            $table->string("pnr")->nullable();
            $table->date("checkin")->nullable();
            $table->date("checkout")->nullable();
            $table->time("checkin_time")->nullable();
            $table->time("checkout_time")->nullable();
            $table->date("up_date")->nullable();
            $table->date("drop_date")->nullable();
            $table->string("up_time")->nullable();
            $table->string("drop_time")->nullable();
            $table->string("it_made")->nullable();
            $table->boolean("is_letter")->default(0);
            $table->string("plate")->nullable();
            $table->string("device")->nullable();
            $table->double("rest",10,2)->default(0);
            $table->enum("status", ['comfirm','closed','waiting'])->default('waiting');
            $table->boolean("login_customer")->default(0);
            $table->longtext("comfirm_token")->nullable();
            $table->decimal("old_total_amount",10,2)->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('reservations');
    }
}
