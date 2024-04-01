<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToCmnPetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cmn_pets', function (Blueprint $table) {
            // Asegúrate de que la columna 'id_dueno' exista y sea del tipo correcto antes de añadir la clave foránea
            $table->foreign('id_dueno')->references('id')->on('cmn_customers')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cmn_pets', function (Blueprint $table) {
            //
        });
    }
}
