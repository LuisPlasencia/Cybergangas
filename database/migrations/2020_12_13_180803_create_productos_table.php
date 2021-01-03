<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->UnsignedInteger('id')->autoIncrement();
            $table->string('tipo');
            $table->string('nombre');
            $table->string('descripcion');
            $table->double('precio');
            $table->double('precioConDescuento');
            $table->double('stock');
            $table->boolean('descuentoActivo');
            $table->string('imagen');
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
        Schema::dropIfExists('productos');
    }
}
