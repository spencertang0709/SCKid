<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create admin, parent and teacher roles
        DB::table('roles')->insert([
            'name' => 'admin',
        ]);

        //Create admin, parent and teacher roles
        DB::table('roles')->insert([
            'name' => 'parent',
        ]);

        //Create admin, parent and teacher roles
        DB::table('roles')->insert([
            'name' => 'teacher',
        ]);
    }
}
