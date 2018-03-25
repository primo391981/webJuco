<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		DB::table('tipo_contenedors')->truncate();
		DB::table('contenedors')->truncate();
		DB::table('contenidos')->truncate();
		DB::table('contenido_contenedor')->truncate();
		DB::table('datos_contenidos')->truncate();
		
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
		
		
		
        $this->call([
		
			TipoContenedorsTableSeeder::class,
			DatosContenidoTableSeeder::class,
			ContenedorsTableSeeder::class,
			ContenidosContenedorsTableSeeder::class,
			ContenidosTableSeeder::class,
		
			UsersTableSeeder::class,
			RolesTableSeeder::class,
			UserRoleTableSeeder::class,
			MenuitemsTableSeeder::class,
			
			
		]);	
    }
}
