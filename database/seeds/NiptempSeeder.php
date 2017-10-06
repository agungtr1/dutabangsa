<?php

use Illuminate\Database\Seeder;

class NiptempSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $posts = [
        			['year'=>'2017','count'=>'00008'],['year'=>'2018','count'=>'00001']
        	   	];

        // masukkan data ke database
		DB::table('niptemps')->insert($posts);
    }
}
