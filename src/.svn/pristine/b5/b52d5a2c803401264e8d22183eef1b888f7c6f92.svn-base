<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{

    const TEAMMATE_ID = 'teammate_id';
    const CASCADE_POLICY = 'cascade';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->foreignId('project_id');
            $table->foreignId(self::TEAMMATE_ID);
            $table->timestamp('assignment_date');


            $table->foreign('project_id')->references('id')->on('projects')->onUpdate(self::CASCADE_POLICY);
            $table->foreign(self::TEAMMATE_ID)->references('id')->on('users')->onUpdate(self::CASCADE_POLICY);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
