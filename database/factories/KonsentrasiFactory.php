<?php

namespace Database\Factories;

use App\Models\Konsentrasi;
use Illuminate\Database\Eloquent\Factories\Factory;

class KonsentrasiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Konsentrasi::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->sentence(mt_rand(1, 3)),
            'jurusan_id' => mt_rand(1, 6)
        ];
    }
}
