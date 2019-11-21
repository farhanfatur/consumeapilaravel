<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create();
        for($i = 1;$i <= 6;$i++) {
        	DB::table('post')->insert([
        		"title" => "title ".$i,
        		"description" => $faker->text,
        		"category" => 'teknologi',
                'user_id' => 1,
        	]);
        }
    }
}
