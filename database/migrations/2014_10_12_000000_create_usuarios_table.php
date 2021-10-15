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
            $table->string('username', 45);
            $table->string('email')->unique();
            $table->string('S_Nombre', 45)->nullable();
            $table->string('S_Apellidos', 45)->nullable();
            $table->string('S_FotoPerfilUrl', 255)->nullable();
            $table->tinyInteger('S_Activo');
            $table->string('password');
            $table->string('verification_token', 191)->nullable();
            $table->string('verified', 191);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            //$table->integer('tw_rol_id'); commented because this doesn't have roles and permissions
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
