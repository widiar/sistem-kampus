<?php

namespace Database\Factories;

use App\Models\MataKuliah;
use Illuminate\Database\Eloquent\Factories\Factory;

class MataKuliahFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MataKuliah::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kode' => $this->faker->bothify('??##??'),
            'nama' => $this->faker->sentence(mt_rand(1, 3)),
            'sks' => $this->faker->randomNumber(2),
            'jurusan_id' => mt_rand(1, 6)
        ];
    }
}
