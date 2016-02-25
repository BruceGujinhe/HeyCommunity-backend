<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Eloquent\Model;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nickname');
            $table->string('avatar');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('password', 60);
            $table->rememberToken();

            $table->softDeletes();
            $table->timestamps();
        });

        Model::unguard();

        \App\User::create([
            'nickname'      =>      'Admin',
            'avatar'        =>      '/assets/images/userAvatar-default.png',
            'email'         =>      'admin@hey-community.cn',
            'phone'         =>      '12312341234',
            'password'      =>      Hash::make('admin1234'),
        ]);

        Model::reguard();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
