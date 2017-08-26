<?php

use Illuminate\Database\Seeder;

class JenisindustriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = [
        			['name'=>'banking'],['name'=>'auditing'],['name'=>'automotive manufacturing'],['name'=>'food & beverage'],['name'=>'retail'],['name'=>'e-commerce'],['name'=>'construction'],['name'=>'service industry'],['name'=>'mining, oil & gas'],['name'=>'property development'],['name'=>'hospitality'],['name'=>'insurance & assurance'],['name'=>'government'],['name'=>'healthcare'],['name'=>'advertising / media'],['name'=>'transportation']
        	   	];

        // masukkan data ke database
		DB::table('jenisindustris')->insert($posts);
    }
}
