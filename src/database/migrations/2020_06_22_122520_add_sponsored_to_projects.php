<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSponsoredToProjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            // if not exist, add the new column
            if (!Schema::hasColumn('projects', 'sponsored')) {
                $table->tinyInteger('sponsored')->default(0);
            }
        });
    }


}
