<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsBannedToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('users', function (Blueprint $table) {
                // if not exist, add the new column
                if (!Schema::hasColumn('users', 'is_banned')) {
                    $table->boolean('is_banned')->nullable();
                }
        });
    }

}
