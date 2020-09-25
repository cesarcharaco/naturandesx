<?php

use Illuminate\Database\Seeder;
use QR_Code\Types\QR_Url;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     
        \DB::table('codigo_qr')->insert([
            'codigo' => '',
            'codigo_recupera' => 1234,
            'status' => 'Activo'
        ]);

        \DB::table('users')->insert([
            'usuario' => 'admin',
            'email' => 'admin@naturandes.cl',
            'password' => bcrypt('123456'),
            'tipo_usuario' => 'admin'
        ]);

        \DB::table('empleados')->insert([
            'id_usuario'=>1,
            'id_qr'=>1,
            'nombres' => 'Administrador',
            'apellidos' => 'admin',
            'rut' =>'12345678-9',
            'telefono' => '04124561254',
            'direccion' => NULL,
            'status' => 'Activo'
        ]);
        //---------- repartidor
        \DB::table('codigo_qr')->insert([
            'codigo' => '',
            'codigo_recupera' => 1234,
            'status' => 'Activo'
        ]);

        \DB::table('users')->insert([
            'usuario' => 'darwis',
            'email' => 'darwis@naturandes.cl',
            'password' => bcrypt('123456'),
            'tipo_usuario' => 'Empleado'
        ]);

        \DB::table('empleados')->insert([
            'id_usuario'=>2,
            'id_qr'=>2,
            'nombres' => 'Darwis',
            'apellidos' => 'Rojas',
            'rut' =>'987654321',
            'telefono' => '04120000000',
            'direccion' => NULL,
            'status' => 'Activo'
        ]);
    }
}
