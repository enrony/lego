<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('identification', 25)->unique();
            $table->string('names', 100);
            $table->string('surnames', 100);
            $table->string('country', 3);
            $table->string('email', 150)->unique();
            $table->string('address', 180);
            $table->string('cell_phone', 10);
            $table->bigInteger('id_category')->unsigned();
                    $table->index('id_category');
                    $table->foreign('id_category')->references('id')->on('categories');
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
        Schema::dropIfExists('usuarios');
    }
}
