<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOilClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oil_clients', function (Blueprint $table) {
            $table->id();
            $table->string('seller');
            $table->string('contragent_title');
            $table->string('contragent_tel');
            $table->string('contragent_name');
            $table->float('client_summa', 10, 2);
            $table->enum('forma_oplati', ['с ндс', 'без ндс', 'нал']);
            $table->float('client_summa_nds', 10, 2);
            $table->integer('maks_skidka');
            $table->integer('client_skidka');
            $table->float('summa_zapravki', 10, 2);
            $table->float('summa_otpravki', 10, 2);
            $table->float('pribl', 10, 2);
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
        Schema::dropIfExists('oil_clients');
    }
}
