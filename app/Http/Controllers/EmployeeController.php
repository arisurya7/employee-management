<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeStoreRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Models\Employee;
use App\Models\EmployeePosition;
use App\Models\Position;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Empty_;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.employee.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.employee.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(EmployeeStoreRequest $request)
    {
        try{
            DB::beginTransaction();
            $data = $request->validated();
            
            //check unit
            $unit = Unit::find($data['unit']);
            if(!$unit){
                $newUnit = Unit::create(['name' => $data['unit']]);
                $unitId = $newUnit->id;
            } else{
                $unitId = $unit->id;
            }
            
            //check position
            $positionIds = [];
            foreach($data['position'] as $position){
                $dataPosition = Position::find($position);
                if(!$dataPosition){
                    $newPosition = Position::create(['name' => $position]);
                    $positionIds[] = $newPosition->id;
                } else{
                    $positionIds[] = $dataPosition->id;
                }
            }
            
            //store employee
            $employee = Employee::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'password' => Crypt::encryptString($data['password']),
                'date_join' => $data['date_join'],
                'unit_id' => $unitId,
            ]);

            //store employee position
            foreach($positionIds as $id){
                EmployeePosition::create([
                    'employee_id' => $employee->id,
                    'position_id' => $id
                ]);
            }

            DB::commit();
            return response()->json(['status' => true, 'message' => 'Sukses menambahkan data'], 201);
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => false, 'message'=>$e->getMessage()],400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Employee::find($id);
        $data->password = Crypt::decryptString($data->password);
       
        $unit = Unit::where('id', $data->unit_id)->get();
        $positions = EmployeePosition::where('employee_id', $data->id)
                    ->join('m_positions', 'employee_position.position_id', '=', 'm_positions.id')
                    ->select(
                        DB::raw('m_positions.name AS name'), 
                        DB::raw('employee_position.position_id AS id')
                    )
                    ->get();
       
        return view('admin.employee.detail', compact('data', 'unit', 'positions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit($id)
    {
        $data = Employee::find($id);
        $data->password = Crypt::decryptString($data->password);
       
        $unit = Unit::where('id', $data->unit_id)->get();
        $positions = EmployeePosition::where('employee_id', $data->id)
                    ->join('m_positions', 'employee_position.position_id', '=', 'm_positions.id')
                    ->select(
                        DB::raw('m_positions.name AS name'), 
                        DB::raw('employee_position.position_id AS id')
                    )
                    ->get();
       
        return view('admin.employee.form', compact('data', 'unit', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(EmployeeUpdateRequest $request, $id)
    {
        try{
            DB::beginTransaction();
            $data = $request->validated();
            
            //check unit
            $unit = Unit::find($data['unit']);
            if(!$unit){
                $newUnit = Unit::create(['name' => $data['unit']]);
                $unitId = $newUnit->id;
            } else{
                $unitId = $unit->id;
            }
            
            //check position
            $positionIds = [];
            foreach($data['position'] as $position){
                $dataPosition = Position::find($position);
                if(!$dataPosition){
                    $newPosition = Position::create(['name' => $position]);
                    $positionIds[] = $newPosition->id;
                } else{
                    $positionIds[] = $dataPosition->id;
                }
            }
            
            //store employee
            $employee = Employee::findOrFail($id);
            $employee->update([
                'name' => $data['name'],
                'username' => $data['username'],
                'password' => Crypt::encryptString($data['password']),
                'date_join' => $data['date_join'],
                'unit_id' => $unitId,
            ]);

            //store employee position
            EmployeePosition::where('employee_id', $employee->id)->delete(); 
            foreach($positionIds as $id){
                EmployeePosition::create([
                    'employee_id' => $employee->id,
                    'position_id' => $id
                ]);
            }

            DB::commit();
            return response()->json(['status' => true, 'message' => 'Sukses menambahkan data'], 201);
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => false, 'message'=>$e->getMessage()],400);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::beginTransaction();
            
            $data = Employee::findOrFail($id);
            $data->delete();

            DB::commit();
            return response()->json(['status' => true, 'message' => 'Sukses menghapus data'], 200);
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function datatable(){
        $data = Employee::join('m_units', 'employee.unit_id', '=', 'm_units.id')
            ->select(
                'employee.id',
                'employee.name',
                'employee.date_join',
                DB::raw('m_units.name AS unit_name')
            )
            ->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row){
                $btn =  $btn = '<a href="' . route('pegawai.show', ['pegawai' => $row->id]) . '"class="btn btn-info btn-sm action-detail" style="margin-left: 5px">Lihat</a>';
                $btn = $btn . '<a href="' . route('pegawai.edit', ['pegawai' => $row->id]) . '"class="btn btn-primary btn-sm action-edit" style="margin-left: 5px">Edit</a>';
                $btn = $btn . '<a type="button" onclick="deleteEmployee(`' . $row->id . '`)" class="btn btn-outline-primary btn-sm action-delete" style="margin-left: 5px">Hapus</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function search_unit(Request $request){
        $keyword = $request->input('term');
        $data = Unit::where('name', 'LIKE', '%'. $keyword . '%')->get();
        $dataOption = [];
        foreach($data as $unit){
            $dataOption[] = ['id' => $unit->id, 'text' => $unit->name];
        }

        return response()->json($dataOption);
    }

    public function search_position(Request $request){
        $keyword = $request->input('term');
        $data = Position::where('name', 'LIKE', '%'. $keyword . '%')->get();
        $dataOption = [];
        foreach($data as $position){
            $dataOption[] = ['id' => $position->id, 'text' => $position->name];
        }

        return response()->json($dataOption);
    }
}
