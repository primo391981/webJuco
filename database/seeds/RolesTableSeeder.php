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
		DB::table('admin_roles')->insert([
            'nombre' => 'superadmin',
			'descripcion' => 'Administrador de los permisos de usuario',
        ]);

		DB::table('admin_roles')->insert([
            'nombre' => 'cmsAdmin',
			'descripcion' => 'Administrador de los contenidos del sitio web',
        ]);
		
		DB::table('admin_roles')->insert([
            'nombre' => 'juridicoAdmin',
			'descripcion' => 'Usuario del sistema jurídico',
        ]);
		
		DB::table('admin_roles')->insert([
            'nombre' => 'contableAdmin',
			'descripcion' => 'Usuario del sistema contable',
        ]);
		
		DB::table('admin_roles')->insert([
            'nombre' => 'invitado',
			'descripcion' => 'Usuario con acceso de lectura y/o escritura a expedientes',
        ]);

    }
}
