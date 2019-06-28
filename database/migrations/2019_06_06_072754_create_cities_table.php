<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('city');
            $table->string('state');
            $table->string('zipcode')->nullable();
            $table->double('latitud')->nullable();
            $table->double('longitud')->nullable();    
            $table->string('country')->default('Argentina');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        DB::table('cities')->insert(array('city' => 'Ciudad Autonoma Buenos Aires', 'state' => 'Buenos Aires', 'zipcode' => 'C1420', 'latitud' => '-34.603333', 'longitud' => '-58.381667', 'country' => 'Argentina'));
        DB::table('cities')->insert(array('city' => 'La Plata', 'state' => 'Buenos Aires', 'zipcode' => 'B1900', 'latitud' => '-34.921111', 'longitud' => '-57.954444', 'country' => 'Argentina'));
        DB::table('cities')->insert(array('city' => 'Rosario', 'state' => 'Santa Fe', 'zipcode' => 'S2000', 'latitud' => '-32.955139', 'longitud' => '-60.666667', 'country' => 'Argentina'));
        DB::table('cities')->insert(array('city' => 'Cordoba', 'state' => 'Cordoba', 'zipcode' => 'X5000', 'latitud' => '-31.416667', 'longitud' => '-64.183333', 'country' => 'Argentina'));
        DB::table('cities')->insert(array('city' => 'Mendoza', 'state' => 'Mendoza', 'zipcode' => 'M5500', 'latitud' => '-32.883333', 'longitud' => '-68.816667', 'country' => 'Argentina'));
        DB::table('cities')->insert(array('city' => 'Ushuaia', 'state' => 'Tierra del Fuego', 'zipcode' => 'V9410', 'latitud' => '-54.801944', 'longitud' => '-68.303056', 'country' => 'Argentina'));
        

        Schema::create('higroupes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('Super Categoria de Empresa');
            $table->string('description')->nullable();
            $table->string('logo')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        DB::table('higroupes')->insert(array('name' => 'Alimentacion', 'description' => 'Food'));
        DB::table('higroupes')->insert(array('name' => 'Deportes', 'description' => 'Sport'));
        DB::table('higroupes')->insert(array('name' => 'Shopping', 'description' => 'Shopping'));
        DB::table('higroupes')->insert(array('name' => 'Tecnologia', 'description' => 'Tecnologia'));
        DB::table('higroupes')->insert(array('name' => 'Casa y Jardin', 'description' => 'Casa y Jardin'));
        DB::table('higroupes')->insert(array('name' => 'Mascotas', 'description' => 'Pets'));
        DB::table('higroupes')->insert(array('name' => 'Aprendizaje', 'description' => 'Learning'));
        DB::table('higroupes')->insert(array('name' => 'Vehiculo y Repuesto', 'description' => 'Vehiculo y Repuesto'));
        DB::table('higroupes')->insert(array('name' => 'Otros', 'description' => 'Otros'));
        
        
        Schema::create('groupes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('higroup_id');
            $table->string('name')->comment('Categoria de Empresa');
            $table->string('description')->nullable();
            $table->string('logo')->nullable();
            $table->string('color')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('status')->default(1);

            $table->timestamps();
            $table->foreign('higroup_id')->references('id')->on('higroupes');
        });

        DB::table('groupes')->insert(array('higroup_id' => '1', 'name' => 'Carnicería y Pollería', 'slug' => 'carniceria'));
        DB::table('groupes')->insert(array('higroup_id' => '1', 'name' => 'Pescaderia', 'slug' => 'carniceria'));
        DB::table('groupes')->insert(array('higroup_id' => '1', 'name' => 'Verduleria', 'slug' => 'verduleria'));
        DB::table('groupes')->insert(array('higroup_id' => '1', 'name' => 'Almacen Y Bebidas', 'slug' => 'almacen'));
        DB::table('groupes')->insert(array('higroup_id' => '1', 'name' => 'Vinoteca', 'slug' => 'vinoteca'));
        DB::table('groupes')->insert(array('higroup_id' => '6', 'name' => 'Tienda de Mascota', 'slug' => 'mascota'));
        DB::table('groupes')->insert(array('higroup_id' => '7', 'name' => 'Librería', 'slug' => 'libreria'));
        DB::table('groupes')->insert(array('higroup_id' => '3', 'name' => 'Perfumería', 'slug' => 'Perfumeria'));
        DB::table('groupes')->insert(array('higroup_id' => '3', 'name' => 'Tienda de Ropa', 'slug' => 'ropa'));
        DB::table('groupes')->insert(array('higroup_id' => '3', 'name' => 'Zapatería', 'slug' => 'zapateria'));
        DB::table('groupes')->insert(array('higroup_id' => '5', 'name' => 'Electrodomestico', 'slug' => 'electrodomestico'));
        DB::table('groupes')->insert(array('higroup_id' => '4', 'name' => 'Electronica', 'slug' => 'electronica'));

        Schema::create('types', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('name')->unique()->comment('typo de Empresa');
          $table->text('description')->nullable();
          $table->string('slug')->nullable();
          $table->boolean('status')->default(1);
        });

        DB::table('types')->insert(array('id' => '1', 'name' => 'Fabrica', 'description' => 'Venta desde Fabrica'));
        DB::table('types')->insert(array('id' => '2', 'name' => 'Mayorista', 'description' => 'Empresa mayorista'));
        DB::table('types')->insert(array('id' => '3', 'name' => 'Minorista', 'description' => 'Empresa Minorista'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
        Schema::dropIfExists('higroupes');
        Schema::dropIfExists('groupes');
        Schema::dropIfExists('types');
    }
}
