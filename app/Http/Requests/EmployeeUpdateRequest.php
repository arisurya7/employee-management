<?php

namespace App\Http\Requests;

use App\Models\Employee;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EmployeeUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public $employeeId;
       /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->employeeId = $this->route('pegawai');
        return [
            'name' => 'required',
            'date_join' => 'required',
            'username' => 'required',
            'password' => 'required',
            'unit' => 'required',
            'position' => 'required'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Nama wajib diisi',
            'date_join.required' => 'Tanggal bergabung wajib diisi',
            'username.required' => 'Username wajib diisi',
            'username.unique' => 'Username harus unik',
            'unit.required' => 'Unit wajib diisi',
            'position.required' => 'Jabatan wajib diisi',
        ];
    }

    public function passedValidation(){
        
        $employee = Employee::where('username', $this->username)->first();
        if($employee->id != $this->employeeId){
            throw new HttpResponseException(
                response()->json([
                    'status' => false,
                    'message' => 'Usename Harus Unik',
                ], 422)
            );
        }
    }

    /**
     * @Override
     */
    public function failedValidation(Validator $validator){
        throw new HttpResponseException(
            response()->json([
                'status' => false,
                'validator' => $validator->errors(),
            ], 422)
        );
    }

}
