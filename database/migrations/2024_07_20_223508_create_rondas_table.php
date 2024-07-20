<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRondasTable extends Migration
{
    public function up()
    {
        Schema::create('rondas', function (Blueprint $table) {
            $table->id();
            $table->string('mesa');
            $table->integer('numeroMesa');
            $table->string('estado');
            $table->string('mesero');
            $table->json('productos');
            $table->json('cantidades');
            $table->json('descripciones');
            $table->double('totalRonda');
            $table->timestamp('timestamp')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rondas');
    }
}
