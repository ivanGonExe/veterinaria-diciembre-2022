<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->datetime('fecha')->nullable();
            $table->integer('cantidad')->nullable();
            $table->float('montoPagado')->nullable();
            $table->float('total')->nullable();
            $table->string('tipoPago')->nullable();
            $table->boolean('estado')->nullable();
            $table->float('descuento')->nullable();     //CAMBIO
            $table->timestamps();
            $table->foreignId('cajero_fk')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
}
