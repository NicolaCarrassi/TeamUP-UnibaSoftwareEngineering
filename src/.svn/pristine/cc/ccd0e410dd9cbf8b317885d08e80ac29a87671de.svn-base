<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class CreateAdminsTable extends Migration
{
    const MAIL = 'email';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string(self::MAIL)->unique();
            $table->string('password');
            $table->timestamps();
        });
    }

    protected function validator(array $data){

        return Validator::make($data, [
            self::MAIL => ['required', 'string', self::MAIL, 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
