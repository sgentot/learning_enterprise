<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       /**
       * Tabla de pedidos.
       *
       * idorder INT NOT NULL AUTO_INCREMENT,
       * idcustomer INT,
       * order VARCHAR(50),
       * ordertype VARCHAR(50),
       * description VARCHAR(500),
       * units  DECIMAL(10,3),
       * totalprice  DECIMAL(10,3),
       * taxes  DECIMAL(10,3),
       * address VARCHAR(500),
       * CONSTRAINT pk_cm_order PRIMARY KEY (idorder),
       * CONSTRAINT un_cm_order_order UNIQUE (order),
       * CONSTRAINT fk_cm_order_idcustomer FOREIGN KEY (idcustomer)
       *
       */
      Schema::create('cm_order', function (Blueprint $table) {
        $table->increments('idorder');
        $table->unsignedInteger('idcustomer');
        $table->foreign('idcustomer')->references('idcustomer')->on('cm_customer');
 
        $table->string('order', 50)->unique();
        $table->string('ordertype', 50);
        $table->string('description', 500);
        $table->decimal('units', $precision = 10, $scale = 3);
        $table->decimal('totalprice', $precision = 10, $scale = 3);
        $table->decimal('taxes', $precision = 10, $scale = 3);
 
        $table->string('address', 50);
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
        Schema::dropIfExists('cmorders');
    }
}
