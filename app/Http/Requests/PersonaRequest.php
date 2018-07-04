<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonaRequest extends FormRequest
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
			'documento'=>'required',
            'nombre'=>'required',
			'apellido'=>'required',
			'domicilio'=>'required',
			'telefono'=>'required',
			'estadoCivil'=>'required',
			'email' => 'email|nullable|unique:persona,email,'.$this->persona,
			'cantHijos'=>'required'
        ];
    }
}
