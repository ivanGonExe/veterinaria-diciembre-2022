<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleClinicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_clinicos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('observaciones');
            $table->date('fechaAtencion');
            $table->string('tratamiento');
            $table->string('patologia');
            $table->float('peso')->nullable();
            $table->foreignId('historialClinico_id')->nullable()->constrained('historial_clinicos')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_clinicos');
    }
}
