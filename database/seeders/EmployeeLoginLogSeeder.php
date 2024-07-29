<?php

namespace Database\Seeders;

use App\Models\EmployeeLoginLog;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EmployeeLoginLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 200;
        for($i=0; $i<$count; $i++){
            EmployeeLoginLog::create(['employee_id' => rand(1, 10), 'created_at' => Carbon::now()]);
        }
    }
}
