<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CategoriaFormRequest extends Request
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
            //Reglas para las validaciones del formulario
            'nombre'=>'required|max:50',
            'descripcion'=>'max:256',
        ];
    }
}
