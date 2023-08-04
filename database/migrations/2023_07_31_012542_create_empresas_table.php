<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // public function up()
    // {
    //     Schema::create('empresas', function (Blueprint $table) {
    //         $table->id();
    //         $table->timestamps();
    //     });
    // }
    public function up()
    {
        Schema::create('empresa', function (Blueprint $table) {
            $table->id('IdEmp');
            $table->string('Nombre');
            $table->string('Direccion');
            $table->string('Correo');
            $table->string('Telefono');
            $table->string('RFC');
            $table->string('Giro');
            $table->string('URLemp');
            $table->unsignedBigInteger('fk_TipoEmp');
            $table->unsignedBigInteger('fk_TamañoEmp');
            $table->timestamps();

            // $table->foreign('fk_TipoEmp')->references('id_Tipo_Emp')->on('tipoemp')->onDelete('cascade');

            $table->foreign('fk_TipoEmp')->references('id_Tipo_Emp')->on('Tamañoemp');
            $table->foreign('fk_TamanoEmp')->references('id_Tamano_Emp')->on('Tamañoemp');
        });

    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
