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
        ]);
		
		DB::table('roles')->insert([
            'nombre' => 'cmsAdmin',
        ]);
		
		DB::table('roles')->insert([
            'nombre' => 'juridicoAdmin',
        ]);
		
		DB::table('roles')->insert([
            'nombre' => 'contableAdmin',
        ]);
    }
}
