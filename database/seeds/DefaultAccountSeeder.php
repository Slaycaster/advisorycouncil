<?php

use Illuminate\Database\Seeder;

class DefaultAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'superadmin',
            'status' => 1,
            'admintype' => 0,
            'email' => 'superadmin',
            'password' => bcrypt('superadmin')
        ]);
    }
}
