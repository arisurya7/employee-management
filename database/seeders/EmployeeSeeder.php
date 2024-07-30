<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\EmployeePosition;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $adminEmployee = Employee::factory()->create([
            'username' => 'admin',
            'unit_id' => 1, 
            'is_admin' => 1
        ]);            
        EmployeePosition::create(['employee_id' => $adminEmployee->id, 'position_id' => 1]);

        $employe = Employee::factory()->create(['unit_id' => 1]);
        EmployeePosition::create(['employee_id' => $employe->id, 'position_id' => 2]);

        $employe = Employee::factory()->create(['unit_id' => 1]);
        EmployeePosition::create(['employee_id' => $employe->id, 'position_id' => 3]);

        $employe = Employee::factory()->create(['unit_id' => 1]);
        EmployeePosition::create(['employee_id' => $employe->id, 'position_id' => 4]);

        $employe = Employee::factory()->create(['unit_id' => 2]);
        EmployeePosition::create(['employee_id' => $employe->id, 'position_id' => 5]);

        $employe = Employee::factory()->create(['unit_id' => 3]);
        EmployeePosition::create(['employee_id' => $employe->id, 'position_id' => 6]);

        $employe = Employee::factory()->create(['unit_id' => 4]);
        EmployeePosition::create(['employee_id' => $employe->id, 'position_id' => 7]);

        $employe = Employee::factory()->create(['unit_id' => 4]);
        EmployeePosition::create(['employee_id' => $employe->id, 'position_id' => 7]);

        $employe = Employee::factory()->create(['unit_id' => 4]);
        EmployeePosition::create(['employee_id' => $employe->id, 'position_id' => 7]);

        $employe = Employee::factory()->create(['unit_id' => 4]);
        EmployeePosition::create(['employee_id' => $employe->id, 'position_id' => 7]);


    }
}
