<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EmployeeStoreRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'date_join' => 'required',
            'username' => 'required|unique:employee',
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