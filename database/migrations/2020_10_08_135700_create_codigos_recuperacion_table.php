<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodigosRecuperacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codigos_recuperacion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->string('codigo');
            $table->enum('status',['Enviado','Vencido','Usado'])->default('Enviado');
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
        Schema::dropIfExists('codigos_recuperacion');
    }
}
