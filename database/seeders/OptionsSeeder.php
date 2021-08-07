<?php

namespace Database\Seeders;

use App\Models\Questions;
use Faker\Factory;
use Illuminate\Database\Seeder;

class OptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $questions = Questions::all();
        foreach ($questions as $question) {
            $correctOption = rand(1, 4);

            foreach (range(1, 4) as $index) {
                $question->options()->create([
                    'text' => $faker->unique()->sentence(),
                    'is_true' => $index == $correctOption ? 1 : 0,
                ]);
            }
        }
    }
}
