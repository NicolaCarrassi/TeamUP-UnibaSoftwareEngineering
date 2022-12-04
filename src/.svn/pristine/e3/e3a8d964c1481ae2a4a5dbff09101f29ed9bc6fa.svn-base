<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsArchivesTable extends Migration
{

    public function up()
    {
        Schema::create('projects_archives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id');
            $table->foreign('project_id')->references('id')->on('projects')->onUpdate('cascade');
            $table->timestamp('end_date');
            $table->boolean('ended');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('projects_archives');
    }
}
