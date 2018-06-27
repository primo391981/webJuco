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
            'razonSocial'=>'required',
			'rut'=>'required|unique:empresa,rut,'.$this->empresa.'|nullable',
			'domicilio'=>'required|nullable',
			'nombreFantasia'=>'required|nullable|unique:empresa,nombreFantasia,'.$this->empresa,
			'numBps'=>'required|nullable|unique:empresa,numBps,'.$this->empresa,
			'numBse'=>'required|nullable|unique:empresa,numBse,'.$this->empresa,
			'numMtss'=>'required|nullable|unique:empresa,numMtss,'.$this->empresa,
			'grupo'=>'nullable',
			'subGrupo'=>'nullable',
			'email'=>'nullable|email|unique:empresa,email,'.$this->empresa,
			'telefono'=>'nullable',
			'nomContacto'=>'nullable'
        ];
    }
}
