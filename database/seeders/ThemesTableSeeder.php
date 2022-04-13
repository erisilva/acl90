<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThemesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('themes')->insert([
            'name' => 'Padrão',
            'description' => 'Tema padrão do Bootstrap',
            'filename' => 'bootstrap.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Cerulean',
            'description' => 'Um céu azul calmo',
            'filename' => 'bootstrap.cerulean.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Darkly',
            'description' => 'Planície no modo noturno',
            'filename' => 'bootstrap.darkly.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Litera',
            'description' => 'O meio é a mensagem',
            'filename' => 'bootstrap.litera.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Materia',
            'description' => 'O material é a metáfora',
            'filename' => 'bootstrap.materia.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Pulse',
            'description' => 'Um traço de roxo',
            'filename' => 'bootstrap.pulse.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Simplex',
            'description' => 'Mini e minimalista',
            'filename' => 'bootstrap.simplex.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Solar',
            'description' => 'Um giro no Solarized',
            'filename' => 'bootstrap.solar.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'United',
            'description' => 'Ubuntu laranja e fonte única',
            'filename' => 'bootstrap.united.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Zephyr',
            'description' => 'Alegre e lindo',
            'filename' => 'bootstrap.zephyr.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Cosmo',
            'description' => 'Uma ode a métrica',
            'filename' => 'bootstrap.cosmo.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Flatly',
            'description' => 'Plano e moderno',
            'filename' => 'bootstrap.flatly.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Lumen',
            'description' => 'Luz e sombra',
            'filename' => 'bootstrap.lumen.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Minty',
            'description' => 'Uma sensação fresca',
            'filename' => 'bootstrap.minty.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Quartz',
            'description' => 'Uma camada vítrea',
            'filename' => 'bootstrap.quartz.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Sketchy',
            'description' => 'Um visual desenhado à mão para maquetes e alegria',
            'filename' => 'bootstrap.sketchy.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Spacelab',
            'description' => 'Prateado e elegante',
            'filename' => 'bootstrap.spacelab.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Vapor',
            'description' => 'Uma estética cyberpunk',
            'filename' => 'bootstrap.vapor.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Cyborg',
            'description' => 'Preto azeviche e azul elétrico',
            'filename' => 'bootstrap.cyborg.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Journal',
            'description' => 'Revigorante como uma nova folha de papel',
            'filename' => 'bootstrap.journal.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'LUX',
            'description' => 'Um toque de classe',
            'filename' => 'bootstrap.lux.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Morph',
            'description' => 'Uma camada neumórfica',
            'filename' => 'bootstrap.morph.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Sandstone',
            'description' => 'Um toque de calor',
            'filename' => 'bootstrap.sandstone.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Slate',
            'description' => 'Tons de cinza metalizado',
            'filename' => 'bootstrap.slate.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Superhero',
            'description' => 'O corajoso e o azul',
            'filename' => 'bootstrap.superhero.min.css',
        ]);  

        DB::table('themes')->insert([
            'name' => 'Yeti',
            'description' => 'Uma base amigável',
            'filename' => 'bootstrap.yeti.min.css',
        ]); 





/*        DB::table('themes')->insert([
            'name' => 'Default',
            'description' => 'Bootstrap default theme',
            'filename' => 'bootstrap.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Cerulean',
            'description' => 'A calm blue sky',
            'filename' => 'bootstrap.cerulean.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Darkly',
            'description' => 'Flatly in night mode',
            'filename' => 'bootstrap.darkly.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Litera',
            'description' => 'The medium is the message',
            'filename' => 'bootstrap.litera.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Materia',
            'description' => 'Material is the metaphor',
            'filename' => 'bootstrap.materia.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Pulse',
            'description' => 'A trace of purple',
            'filename' => 'bootstrap.pulse.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Simplex',
            'description' => 'Mini and minimalist',
            'filename' => 'bootstrap.simplex.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Solar',
            'description' => 'A spin on Solarized',
            'filename' => 'bootstrap.solar.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'United',
            'description' => 'Ubuntu orange and unique font',
            'filename' => 'bootstrap.united.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Zephyr',
            'description' => 'Breezy and beautiful',
            'filename' => 'bootstrap.zephyr.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Cosmo',
            'description' => 'An ode to Metro',
            'filename' => 'bootstrap.cosmo.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Flatly',
            'description' => 'Flat and modern',
            'filename' => 'bootstrap.flatly.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Lumen',
            'description' => 'Light and shadow',
            'filename' => 'bootstrap.lumen.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Minty',
            'description' => 'A fresh feel',
            'filename' => 'bootstrap.minty.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Quartz',
            'description' => 'A glassmorphic layer',
            'filename' => 'bootstrap.quartz.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Sketchy',
            'description' => 'A hand-drawn look for mockups and mirth',
            'filename' => 'bootstrap.sketchy.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Spacelab',
            'description' => 'Silvery and sleek',
            'filename' => 'bootstrap.spacelab.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Vapor',
            'description' => 'A cyberpunk aesthetic',
            'filename' => 'bootstrap.vapor.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Cyborg',
            'description' => 'Jet black and electric blue',
            'filename' => 'bootstrap.cyborg.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Journal',
            'description' => 'Crisp like a new sheet of paper',
            'filename' => 'bootstrap.journal.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'LUX',
            'description' => 'A touch of class',
            'filename' => 'bootstrap.lux.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Morph',
            'description' => 'A neumorphic layer',
            'filename' => 'bootstrap.morph.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Sandstone',
            'description' => 'A touch of warmth',
            'filename' => 'bootstrap.sandstone.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Slate',
            'description' => 'Shades of gunmetal gray',
            'filename' => 'bootstrap.slate.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Superhero',
            'description' => 'The brave and the blue',
            'filename' => 'bootstrap.superhero.min.css',
        ]);  

        DB::table('themes')->insert([
            'name' => 'Yeti',
            'description' => 'A friendly foundation',
            'filename' => 'bootstrap.yeti.min.css',
        ]); */                      

    }
}
