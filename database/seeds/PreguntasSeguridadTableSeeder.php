<?php

use Illuminate\Database\Seeder;

class PreguntasSeguridadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        \DB::table('preguntas_seguridad')->insert([
        	'pregunta' => 'Nombre de mascota'
        ]);

        \DB::table('preguntas_seguridad')->insert([
        	'pregunta' => 'Sobrino favorito'
        ]);

        \DB::table('preguntas_seguridad')->insert([
        	'pregunta' => 'Ingrediente favorito de la pizza'
        ]);

        \DB::table('preguntas_seguridad')->insert([
        	'pregunta' => 'Deporte favorito'
        ]);

        \DB::table('preguntas_seguridad')->insert([
        	'pregunta' => 'Nombre de amigo de la infancia'
        ]);
    }
}
