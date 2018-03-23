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
		DB::table('users')->insert([
            'name' => 'superadmin',
            'email' => 'superadmin@mail.com',
            'password' => bcrypt('123456'),
        ]);
		
		DB::table('users')->insert([
            'name' => 'cms',
            'email' => 'cms@mail.com',
            'password' => bcrypt('123456'),
        ]);
		
		DB::table('users')->insert([
            'name' => 'juridico',
            'email' => 'juridico@mail.com',
            'password' => bcrypt('123456'),
        ]);
		
		DB::table('users')->insert([
            'name' => 'contable',
            'email' => 'contable@mail.com',
            'password' => bcrypt('123456'),
        ]);
		
		DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
