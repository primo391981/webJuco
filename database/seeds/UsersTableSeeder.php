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
			'nombre' => 'Gilberto',
			'apellido' => 'Gil',
        ]);
		
		DB::table('admin_users')->insert([
            'name' => 'cms',
            'email' => 'cms@mail.com',
            'password' => bcrypt('123456'),
			'nombre' => 'Luis',
			'apellido' => 'Fonsi',
        ]);
		
		DB::table('admin_users')->insert([
            'name' => 'juridico',
            'email' => 'juridico@mail.com',
            'password' => bcrypt('123456'),
			'nombre' => 'Lolo',
			'apellido' => 'Estoyanof',
        ]);
		
		DB::table('admin_users')->insert([
            'name' => 'contable',
            'email' => 'contable@mail.com',
            'password' => bcrypt('123456'),
			'nombre' => 'Kami',
			'apellido' => 'Rachmanj',
        ]);
		
		DB::table('admin_users')->insert([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('123456'),
			'nombre' => 'Thalia',
			'apellido' => 'Sodi',
        ]);
    }
}
