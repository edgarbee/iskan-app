<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOilClientVoditelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oil_client_voditels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tel');
            $table->enum('vink', ['Лукойл', 'Газпромнефть', 'Роснефть']);
            $table->string('oil');
            $table->integer('card_number')->nullable();
            $table->integer('limit');
            $table->unsignedBigInteger('oil_client_id')->nullable();
            $table->timestamps();

            $table->index('oil_client_id', 'oil_client_voditel_idx');
            $table->foreign('oil_client_id', 'oil_client_voditel_fk')->on('oil_clients')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oil_client_voditels');
    }
}
