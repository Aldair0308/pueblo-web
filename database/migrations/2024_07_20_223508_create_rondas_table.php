<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRondasTable extends Migration
{
    public function up()
    {
        Schema::create('ronda', function (Blueprint $table) {
            $table->id();
            $table->string('mesa')->nullable(); // Campo opcional
            $table->integer('numeroMesa')->nullable(); // Campo opcional
            $table->string('estado')->nullable(); // Campo opcional
            $table->string('mesero')->nullable(); // Campo opcional
            $table->json('productos')->nullable(); // Campo opcional
            $table->json('cantidades')->nullable(); // Campo opcional
            $table->json('descripciones')->nullable(); // Campo opcional
            $table->double('totalRonda')->nullable(); // Campo opcional
            $table->timestamp('timestamp')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ronda');
    }
}
