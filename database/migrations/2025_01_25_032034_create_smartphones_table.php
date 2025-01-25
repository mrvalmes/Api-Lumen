<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmartphonesTable extends Migration
{
    public function up()
    {
        Schema::create('smartphones', function (Blueprint $table) {
            $table->id();
            $table->string('Brand');
            $table->string('Model');
            $table->integer('Ram');
            $table->integer('Rom');
            $table->double('ScreenSize');
            $table->integer('Battery');
            $table->double('Price');
            $table->string('Color');
            $table->integer('CameraPixels');
            $table->string('Network');
            $table->string('Availability');
            $table->string('Img');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('smartphones');
    }
}