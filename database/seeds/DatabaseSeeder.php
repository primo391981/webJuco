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
        $this->call([
			ContenedorsTableSeeder::class,
			TipoContenedorsTableSeeder::class,
			ContenidosTableSeeder::class,
			ContenedorContenidoTableSeeder::class,
			UsersTableSeeder::class,
			RolesTableSeeder::class,
			UserRoleTableSeeder::class,
			
			
		]);	
    }
}
