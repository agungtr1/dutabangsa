<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        /*$this->call(JenisindustriSeeder::class);*/
        // factory(App\Peserta::class, 100)->create();
        $this->call(NiptempSeeder::class);
    }
}
