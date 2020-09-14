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
        \DB::table('users')->insert([
        	'name' => 'Administrador',
        	'email' => 'admin@naturandes.cl',
        	'password' => bcrypt('123456'),
            'tipo_usuario' => 'admin'
        ]);
    }
}
