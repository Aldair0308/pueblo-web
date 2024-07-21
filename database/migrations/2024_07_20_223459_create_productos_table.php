<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    public function up()
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->id();
            $table->string('foto')->default('photo_product.jpg');
            $table->string('nombre');
            $table->double('precio');
            $table->string('descripcion')->default('Normal');
        });
    }

    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
