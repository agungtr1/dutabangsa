<?php

use Illuminate\Database\Seeder;

class JeniskelasSeeder extends Seeder
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
        			['name'=>'Reguler'],['name'=>'IHT'],['name'=>'Private Class'],['name'=>'Seminar'],['name'=>'Public Class'],['name'=>'Outbond']
        	   	];

        // masukkan data ke database
		DB::table('jeniskelas')->insert($posts);
    }
}
