<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'adm@mail.com',
            'active' => 'Y',
            'password' => Hash::make('123456'),
            'theme_id' => 1,
        ]);

        DB::table('users')->insert([
            'name' => 'Gerente',
            'email' => 'gerente@mail.com',
            'active' => 'Y',
            'password' => Hash::make('123456'),
            'theme_id' => 1,
        ]);

        DB::table('users')->insert([
            'name' => 'Operador',
            'email' => 'operador@mail.com',
            'active' => 'Y',
            'password' => Hash::make('123456'),
            'theme_id' => 1,
        ]);

        DB::table('users')->insert([
            'name' => 'Leitor',
            'email' => 'leitor@mail.com',
            'active' => 'Y',
            'password' => Hash::make('123456'),
            'theme_id' => 1,
        ]);
    }
}
