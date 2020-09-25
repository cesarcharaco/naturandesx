<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodigoQrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codigo_qr', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo');
            $table->string('codigo_recupera');
            $table->enum('status',['Activo','Inactivo','Sin Aprobar'])->default('Activo');
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
        Schema::dropIfExists('codigo_qr');
    }
}
