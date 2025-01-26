<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturasTable extends Migration
{
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cliente');
            $table->unsignedBigInteger('smartphone_id');
            $table->integer('cantidad')->default(1);
            $table->decimal('monto_total', 10, 2)->default(0);
            $table->timestamps();

            // Si quieres la relación con smartphones
            $table->foreign('smartphone_id')->references('id')->on('smartphones');
        });
    }

    public function down()
    {
        Schema::dropIfExists('facturas');
    }
}
