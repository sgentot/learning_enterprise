<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmEnterprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       /**
         * Tabla para controlar las empresas que se usan en la aplicación,
         * la aplicación se desarrolla en función de estos parámetros ya que
         * habrá algunas tablas que serán comunes a las empresa y otras que no,
         * por ejemplo, cada empresa tendrá sus propios clientes,
         * pero tendrá los mismos idiomas, monedas y países de trabajo.
         *   identerprise INT NOT NULL AUTO_INCREMENT,
         *   enterprise VARCHAR(150),
         *   description VARCHAR(250),
         *   contact VARCHAR(250),
         *   estate VARCHAR(30),
         *   country VARCHAR(100),
         *   currency VARCHAR(100),
         *   elanguage VARCHAR(6),
         *
         */
        Schema::create('cm_enterprise', function (Blueprint $table) {
            $table->increments('identerprise');
            $table->string('enterprise', 150)->nullable(false);
            $table->string('description', 250);
            $table->string('contact', 250);
            $table->string('estate', 30);
            $table->string('currency', 100);
            $table->string('country', 100);
            $table->string('elanguage', 6);
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
        Schema::dropIfExists('cm_enterprises');
    }
}
