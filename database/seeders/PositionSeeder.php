<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Position::factory()->create(['name' => 'Admin']);
        Position::factory()->create(['name' => 'Software Enginner']);
        Position::factory()->create(['name' => 'IT Suport']);
        Position::factory()->create(['name' => 'Desain Grafis']);
        Position::factory()->create(['name' => 'Accounting']);
        Position::factory()->create(['name' => 'HR']);
        Position::factory()->create(['name' => 'Sales']);
    }
}
