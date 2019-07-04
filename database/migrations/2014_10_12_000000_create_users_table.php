<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{

  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('provider')->nullable();
      $table->string('provider_uid')->nullable();
      $table->string('name')->comment('Nombre del usuario');
      $table->string('email')->unique();
      $table->string('password')->nullable();
      $table->string('avatar')->default('avatar.jpg');
      $table->string('phone')->nullable();
      $table->text('address')->nullable();
      $table->double('latitud')->nullable();
      $table->double('longitud')->nullable();
      $table->string('slug')->nullable();
      $table->boolean('status')->default(1);
      $table->timestamp('email_verified_at')->nullable();
      $table->rememberToken();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('users');
  }
}
