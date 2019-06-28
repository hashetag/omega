<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
  
  public function up()
  {
    Schema::create('roles', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('name')->unique()->comment('role del Empresa');
      $table->text('description')->nullable();
    });

    DB::table('roles')->insert(array('id' => '1', 'name' => 'Admin', 'description' => 'Administrador del Sistema'));
    DB::table('roles')->insert(array('id' => '2', 'name' => 'Empresa', 'description' => 'Empresa o Negocio'));

    Schema::create('emp_subscriptions', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('name')->unique()->comment('abono');
      $table->text('description')->nullable();
      $table->text('benefit')->nullable();
      $table->text('detail')->nullable();
      $table->decimal('price',11,2);
      $table->boolean('status')->default(1);
    });

    DB::table('emp_subscriptions')->insert(['id' => '1', 'name' => 'Gratis', 'price' => '0.00']);
    DB::table('emp_subscriptions')->insert(['id' => '2', 'name' => 'Basic', 'price' => '499.95']);
    DB::table('emp_subscriptions')->insert(['id' => '3', 'name' => 'Standard', 'price' => '1499.95']);
    DB::table('emp_subscriptions')->insert(['id' => '4', 'name' => 'Premium', 'price' => '4999.95']);
    DB::table('emp_subscriptions')->insert(['id' => '5', 'name' => 'Gold', 'price' => '9999.95']);


    Schema::create('empresas', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->unsignedBigInteger('role_id')->default(2);
      $table->string('name')->comment('Nombre de la empresa');
      $table->string('email')->unique();
      $table->string('password');
      $table->unsignedBigInteger('groupe_id');
      $table->unsignedBigInteger('city_id');
      $table->unsignedBigInteger('type_id')->default(3);
      $table->unsignedBigInteger('plan_id')->default(1);
      $table->string('cuit')->nullable();
      $table->string('avatar')->nullable();
      $table->string('phone')->nullable();
      $table->text('address')->nullable();
      $table->text('openhours')->nullable();
      $table->double('minimum')->nullable();
      $table->double('shipping')->nullable();
      $table->double('latitud')->nullable();
      $table->double('longitud')->nullable();
      $table->string('slug')->nullable();
      $table->boolean('status')->default(1);
      $table->rememberToken();
      $table->timestamps();

      $table->foreign('role_id')->references('id')->on('roles');
      $table->foreign('groupe_id')->references('id')->on('groupes');
      $table->foreign('type_id')->references('id')->on('types');
      $table->foreign('city_id')->references('id')->on('cities');
      $table->foreign('plan_id')->references('id')->on('emp_subscriptions');
    });
  }
 
  public function down()
  {
    Schema::dropIfExists('roles');
    Schema::dropIfExists('empresas');
    Schema::dropIfExists('emp_subscriptions');
  }
}
