<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMesasTable extends Migration
{
    public function up()
    {
        Schema::create('mesa', function (Blueprint $table) {
            $table->id();
            $table->integer('noMesa');
            $table->string('cliente')->nullable();
            $table->string('estado');
            $table->double('totalCuenta')->default(0);
            $table->timestamp('horaPago')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mesa');
    }
}
