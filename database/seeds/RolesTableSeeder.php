<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		DB::table('roles')->insert([
            'nombre' => 'superadmin',
			'descripcion' => 'Administrador de los permisos de usuario',
        ]);
		
		DB::table('roles')->insert([
            'nombre' => 'cmsAdmin',
			'descripcion' => 'Administrador de los contenidos del sitio web',
        ]);
		
		DB::table('roles')->insert([
            'nombre' => 'juridicoAdmin',
			'descripcion' => 'Usuario del sistema jurídico',
        ]);
		
		DB::table('roles')->insert([
            'nombre' => 'contableAdmin',
			'descripcion' => 'Usuario del sistema contable',
        ]);
    }
}
