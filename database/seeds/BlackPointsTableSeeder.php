<?php

use Illuminate\Database\Seeder;

class BlackPointsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\BlackPoint::class, 20)->create();
    }
}
