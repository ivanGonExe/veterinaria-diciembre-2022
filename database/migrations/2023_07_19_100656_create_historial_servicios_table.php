<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_servicios', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('mascota_id')->nullable()->constrained('mascotas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('peluquero_fk')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historial_servicios');
    }
}
