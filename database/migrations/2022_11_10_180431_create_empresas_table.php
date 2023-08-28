<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion')->nullable();
            $table->string('instagram')->nullable();
            $table->string('telefonoFijo')->nullable();
            $table->string('celular')->nullable();
            $table->string('direccion')->nullable();
            $table->string('mapa')->nullable();
            $table->timestamps();
            $table->foreignId('admin_fk')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
