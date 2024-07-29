<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\EmployeePosition;
use App\Models\Position;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeePositionFactory extends Factory
{

    protected $model = EmployeePosition::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'employee_id' => Employee::factory()->create()->id,
            'position_id' => Position::factory()->create()->id
        ];
    }
}
