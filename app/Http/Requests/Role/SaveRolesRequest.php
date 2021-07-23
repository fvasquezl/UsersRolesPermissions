<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

class SaveRolesRequest extends FormRequest
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
        $roles = ['display_name' => 'required'];

        if ($this->method() != 'PUT') {

            $roles['name'] = 'required|unique:roles';
        }

        return $roles;
    }

    public function messages()
    {
        return [
            'name.required' => 'El identificador del role es obligatorio',
            'name.unique' => 'El identificador del role ya ha sido registrado',
            'display_name.required'=> 'El nombre del role es obligatorio'
        ];
    }
}
