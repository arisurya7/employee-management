<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeLoginLog;
use App\Models\EmployeePosition;
use App\Models\Position;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index(){
        $data = [
            'count_employee' => Employee::count(),
            'count_unit' => Unit::count(),
            'count_position' => Position::count(),
            'count_login' => EmployeeLoginLog::count()
        ];

        return view("admin.dashboard.index", compact('data'));
    }

    public function datatable(Request $request){

        $query = EmployeeLoginLog::join('employee', 'employee_login_log.employee_id', '=', 'employee.id');

        if(isset($request->start_date)){
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $query->where('employee_login_log.created_at', '>=', $startDate);
        }

        if(isset($request->end_date)){
            $endDate = Carbon::parse($request->end_date)->endOfDay();
            $query->where('employee_login_log.created_at', '<=', $endDate);
        }

        $data = $query->select('employee.id', 'employee.name', DB::raw('COUNT(*) AS login_count'))
            ->groupBy('employee_login_log.employee_id')
            ->having('login_count', '>', 25)
            ->orderBy('login_count', 'desc')
            ->take(10)
            ->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);

    }

    public function count_ajax(Request $request){
        try{
            $employee = Employee::select('id');
            $unit = Unit::select('id');
            $position = Position::select('id');
            $login = EmployeeLoginLog::select('id');

            if(isset($request->start_date)){
                $startDate = Carbon::parse($request->start_date)->startOfDay();
                $employee->where('created_at', '>=', $startDate);
                $unit->where('created_at', '>=', $startDate);
                $position->where('created_at', '>=', $startDate);
                $login->where('created_at', '>=', $startDate);
            }

            if(isset($request->end_date)){
                $endDate = Carbon::parse($request->end_date)->endOfDay();
                $employee->where('created_at', '<=', $endDate);
                $unit->where('created_at', '<=', $endDate);
                $position->where('created_at', '<=', $endDate);
                $login->where('created_at', '<=', $endDate);
            }

            $data = [
                'count_employee' => $employee->count(),
                'count_unit' => $unit->count(),
                'count_position' => $position->count(),
                'count_login' => $login->count(),
            ];

            return response()->json(['status' => true, 'data' => $data, 'message' => 'Filter berhasil'], 200);

        }catch(\Exception $e){
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
