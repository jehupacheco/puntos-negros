<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $status = [
            ['id'=>'1', 'name' => 'Activo'],
            ['id'=>'2', 'name' => 'En revisión'],
            ['id'=>'3', 'name' => 'Cerrado'],
        ];

        DB::table('status')->insert($status);
    }
}
