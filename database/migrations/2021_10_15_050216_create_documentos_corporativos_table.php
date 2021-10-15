<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosCorporativosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos_corporativos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tw_corporativos_id')->references('id')->on('corporativos');
            $table->foreignId('tw_documentos_id')->references('id')->on('documentos');
            $table->string('S_ArchivoUrl',255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documentos_corporativos');
    }
}
