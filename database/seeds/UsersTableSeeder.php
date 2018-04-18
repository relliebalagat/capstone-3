<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
        	DB::table('users')->insert([
        		'name' => $faker->name,
        		'username' => $faker->username,
                'short_description' => $faker->paragraph($nbSentences = 1, $variableNbSentences = true),
        		'email' => $faker->email,
        		'password' => bcrypt('secret'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
        	]);
        }
    }
}
