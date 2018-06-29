<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresaRequest extends FormRequest
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
            'rut'=>'nullable|unique:empresa,rut,'.$this->empresa,
			'razonSocial'=>'required',
			'nombreFantasia'=>'required|unique:empresa,nombreFantasia,'.$this->empresa,
			'numBps'=>'nullable|unique:empresa,numBps,'.$this->empresa,
			'numBse'=>'nullable|unique:empresa,numBse,'.$this->empresa,
			'numMtss'=>'nullable|unique:empresa,numMtss,'.$this->empresa,
			'email'=>'email|nullable|unique:empresa,email,'.$this->empresa,
			
        ];
    }
}
