<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadosHasVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados_has_ventas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_empleado');
            $table->unsignedBigInteger('id_venta');
            $table->enum('status',['Cancelado','No Cancelado'])->default('No Cancelado');

            $table->foreign('id_empleado')->references('id')->on('empleados')->onDelete('cascade');
            $table->foreign('id_venta')->references('id')->on('ventas')->onDelete('cascade');
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
        Schema::dropIfExists('empleados_has_ventas');
    }
}
