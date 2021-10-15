<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorporativosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corporativos', function (Blueprint $table) {
            $table->id();
            $table->string('S_NombreCorto', 45);
            $table->string('S_NombreCompleto', 75);
            $table->string('S_LogoURL', 255)->nullable();
            $table->string('S_DBName', 45);
            $table->string('S_DBUsuario', 45);
            $table->string('S_DBPassword', 150);
            $table->string('S_SystemUrl', 255);
            $table->tinyInteger('S_Activo');
            $table->timestamp('D_FechaIncorporacion');
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('tw_usuarios_id')->references('id')->on('usuarios');
            $table->foreignId('FK_Asignado_id')->nullable()->references('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('corporativos');
    }
}
