<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura', function (Blueprint $table) {
            $table->UnsignedInteger('id')->autoIncrement();
            $table->unsignedInteger('id_orden');
            $table->foreign('id_orden')->references('id')->on('ordenes');
            $table->unsignedInteger('id_usuario');
            $table->foreign('id_usuario')->references('id')->on('usuario');
            $table->string('estado');
            $table->string('moneda');
            $table->double('total');
            $table->string('formaDePago');

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
        Schema::dropIfExists('factura');
    }
}
