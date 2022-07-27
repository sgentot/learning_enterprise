<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmcustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cm_customer', function (Blueprint $table) {
            $table->increments('idcustomer');
            $table->unsignedInteger('identerprise');
            $table->foreign('identerprise')->references('identerprise')->on('cm_enterprise');
            $table->string('customer', 150);
            $table->string('customerstate', 30);
            $table->string('contact', 250);
            $table->string('paymentmethod', 50);
            $table->string('currency', 100);
            $table->string('country', 100);
            $table->string('elanguage', 6);
            $table->string('address', 50);
            $table->timestamps();
            $table->engine = 'InnoDB';   // Specify the table storage engine (MySQL).
     
          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cmcustomer');
    }
}
