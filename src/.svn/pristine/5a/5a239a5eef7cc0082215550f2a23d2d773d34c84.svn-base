<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetencesForIdeasTable extends Migration
{
    const CASCADE_PROP = 'cascade';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competences_for_ideas', function (Blueprint $table) {
            $table->foreignId('project_id');
            $table->foreign('project_id')->references('id')->on('projects')->onUpdate(self::CASCADE_PROP)->onDelete(self::CASCADE_PROP);
            $table->foreignId('competence_id');
            $table->foreign('competence_id')->references('id')->on('competences')->onUpdate(self::CASCADE_PROP)->onDelete(self::CASCADE_PROP);
            $table->integer('level');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('competences_for_ideas');
    }
}
