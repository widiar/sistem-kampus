<?php

namespace Database\Seeders;

use App\Models\Konsentrasi;
use Illuminate\Database\Seeder;

class KonsentrasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Konsentrasi::factory(10)->create();
    }
}
