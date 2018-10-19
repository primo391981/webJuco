<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		DB::table('admin_users')->insert([
            'name' => 'superadmin',
            'email' => 'superadmin@mail.com',
            'password' => bcrypt('123456'),
			'nombre' => 'Administrador',
			'apellido' => 'Usuarios',
        ]);
		
		DB::table('admin_users')->insert([
            'name' => 'cms',
            'email' => 'cms@mail.com',
            'password' => bcrypt('123456'),
			'nombre' => 'Jorge',
			'apellido' => 'Perez',
        ]);
		
		DB::table('admin_users')->insert([
            'name' => 'juridico',
            'email' => 'juridico@mail.com',
            'password' => bcrypt('123456'),
			'nombre' => 'Ana',
			'apellido' => 'Lopez',
        ]);
		
		DB::table('admin_users')->insert([
            'name' => 'contable',
            'email' => 'contable@mail.com',
            'password' => bcrypt('123456'),
			'nombre' => 'Luis',
			'apellido' => 'Rosas',
        ]);
		
		DB::table('admin_users')->insert([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('123456'),
			'nombre' => 'Pedro',
			'apellido' => 'Rocha',
        ]);
		
		DB::table('admin_users')->insert([
            'name' => 'readJuridico',
            'email' => 'csosa@mail.com',
            'password' => bcrypt('123456'),
			'nombre' => 'Carlos',
			'apellido' => 'Sosa',
        ]);
		
		DB::table('admin_users')->insert([
            'name' => 'writeJuridico',
            'email' => 'sgomez@mail.com',
            'password' => bcrypt('123456'),
			'nombre' => 'Sergio',
			'apellido' => 'Gómez',
        ]);
    }
}
