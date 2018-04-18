<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Question;
use Carbon\Carbon;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	
        $faker = Faker::create();
        $limit = 20;

        for ($i = 0; $i < $limit; $i++) { 
            $question = new Question();
            $question->questions = $faker->paragraph($nbSentences = 1, $variableNbSentences = true);
            $question->user_id = $faker->numberBetween($min = 2, $max = 11);
            $question->category_id = $faker->numberBetween($min = 1, $max = 8);
            $question->created_at = Carbon::now();
            $question->updated_at = Carbon::now();
            $question->save();
            // $question->category()->sync([$question->category_id]);
        }
    }
}
