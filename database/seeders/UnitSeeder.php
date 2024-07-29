<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::factory()->create(['name' => 'IT']);
        Unit::factory()->create(['name' => 'Finance']);
        Unit::factory()->create(['name' => 'SDM']);
        Unit::factory()->create(['name' => 'Marketing']);
    }
}
