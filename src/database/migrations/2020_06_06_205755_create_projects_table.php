<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longtext('description');
            $table->foreignId('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade');
            $table->foreignId('leader_id');
            $table->foreign('leader_id')->references('id')->on('users')->onUpdate('cascade');
            $table->unsignedSmallInteger('numberOfComponentsRequired');
            $table->unsignedSmallInteger('numberOfComponentsActual');
            $table->string('image')->nullable();
            $table->boolean('needToMeet')->nullable();
            $table->string('city')->nullable();
            $table->timestamp('idea_proposal_at')->nullable();
            $table->timestamp('idea_start_at')->nullable();
            $table->softDeletes();
            $table->index('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
