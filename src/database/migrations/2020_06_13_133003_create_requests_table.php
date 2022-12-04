<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teammate_id');
            $table->foreignId('project_id');
            $table->longText('description')->nullable();
            $table->timestamp('sent_at');
            $table->tinyInteger('state')->default(0); //indica lo stato della richiesta: 0 se inviata e senza risposta dal leader, 1 se accettata, 2 se rifiutata

            $table->foreign('teammate_id')->references('id')->on('users');
            $table->foreign('project_id')->references('id')->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
