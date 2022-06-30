<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        foreach(range(1,10) as $value){
            
            DB::table("students")->insert([
                "name" => $faker->name(),
                "city" => $faker->city(),
                "fees" => random_int(1500,2000)
            ]);
        
        }
    }
}
