<?php

namespace Database\Factories;

use App\Models\Questions;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Questions::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'text' =>  $this->faker->sentence(mt_rand(5, 15)),
            'score' => 10,
        ];
    }
}
