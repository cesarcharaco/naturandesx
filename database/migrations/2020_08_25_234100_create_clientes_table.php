<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_qr');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('rut');
            $table->string('telefono');
            $table->enum('status',['Activo','Inactivo','Sin Aprobar']);

            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_qr')->references('id')->on('codigo_qr')->onDelete('cascade');
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
        Schema::dropIfExists('clientes');
    }
}
