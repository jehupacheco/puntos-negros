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
        DB::table('users')->insert([
            'name' => 'Funcionario Administrador',
            'email' => 'admin@admin.com',
            'password' => bcrypt('secret'),
            'user_type_id' => '1',
        ]);

        DB::table('users')->insert([
            'name' => 'Funcionaria Secretaria',
            'email' => 'secretaria@admin.com',
            'password' => bcrypt('secret'),
            'user_type_id' => '1',
        ]);

        DB::table('users')->insert([
            'name' => 'Funcionario Jefe',
            'email' => 'jefe@admin.com',
            'password' => bcrypt('secret'),
            'user_type_id' => '1',
        ]);

        DB::table('users')->insert([
            'name' => 'Jehu',
            'email' => 'jehu@admin.com',
            'password' => bcrypt('secret'),
            'user_type_id' => '2',
        ]);

        DB::table('users')->insert([
            'name' => 'Leila',
            'email' => 'leila@admin.com',
            'password' => bcrypt('secret'),
            'user_type_id' => '2',
        ]);
    }
}
