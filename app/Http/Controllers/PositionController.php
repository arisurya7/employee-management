<?php

namespace App\Http\Controllers;

use App\Http\Requests\PositionStoreRequest;
use App\Http\Requests\PositionUpdateRequest;
use App\Models\Employee;
use App\Models\EmployeePosition;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.position.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(PositionStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            Position::create([
                'name' => $data['name']
            ]);
            DB::commit();
            return response()->json(['status' => true, 'message' => 'Sukses menambahkan data'], 201); 
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(PositionUpdateRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $position = Position::findOrFail($id);
            $position->update([
                'name' => $data['name']
            ]);
            DB::commit();
            return response()->json(['status' => true, 'message' => 'Sukses update data'], 200); 
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
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
            $position = Position::findOrFail($id);
            $countEmployePosition = EmployeePosition::where('position_id', $id)->count();

            if($countEmployePosition > 0){
                throw new \Exception('Data unit masih digunakan pada pegawai');
            }
            $position->delete();
            DB::commit();
            return response()->json(['status' => true, 'message' => 'Sukses menghapus data'], 200);
        }catch(\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function datatable(){
        $data = Position::select('id', 'name')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn =  '<a type="button" onclick="show(' . $row->id . ',`'. $row->name .'`)" class="btn btn-outline-primary btn-sm action-show" style="margin-left: 5px">Lihat</a>';
                $btn = $btn . '<a type="button" onclick="edit(' . $row->id . ',`'. $row->name .'`)" class="btn btn-outline-primary btn-sm action-edit"  style="margin-left: 5px">Edit</a>';
                $btn = $btn . '<a type="button" onclick="deletePosition(' . $row->id . ')" class="btn btn-outline-danger btn-sm action-delete" style="margin-left: 5px">Hapus</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);

    }
}
