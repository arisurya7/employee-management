<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{

    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'username' => $this->faker->unique()->userName(),
            'password' => 'password',
            'date_join' => Carbon::now()->format('Y-m-d'),
            'unit_id' => 1,
            'is_admin' => 0
        ];
    }
}
