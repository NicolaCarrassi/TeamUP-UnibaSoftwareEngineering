<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAvatarToUsers extends Migration
{

    const TABLE_NAME = 'users';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(self::TABLE_NAME, function (Blueprint $table) {
            // if not exist, add the new column
            if (!Schema::hasColumn(self::TABLE_NAME, 'avatar')) {
                $table->string('avatar')->default(config('chatify.user_avatar.default'))->after('email');
            }
        });
    }


}
