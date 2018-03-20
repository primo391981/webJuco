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
            'name' => 'superadmin',
        ]);
		
		DB::table('roles')->insert([
            'name' => 'cmsAdmin',
        ]);
		
		DB::table('roles')->insert([
            'name' => 'juridicoAdmin',
        ]);
		
		DB::table('roles')->insert([
            'name' => 'contableAdmin',
        ]);
    }
}
