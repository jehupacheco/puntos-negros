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
            'name' => 'Funcionario',
            'email' => 'admin@admin.com',
            'password' => bcrypt('secret'),
            'user_type_id' => '1',
        ]);

        DB::table('users')->insert([
            'name' => 'Funcionario',
            'email' => 'user@admin.com',
            'password' => bcrypt('secret'),
            'user_type_id' => '2',
        ]);
    }
}
