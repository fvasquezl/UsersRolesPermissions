<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class RoleRequest extends FormRequest
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

        $rules = [
            'name' => ['required', 'string', 'max:255', Rule::unique('roles')],
            'display_name' => ['required', 'string', 'max:255', Rule::unique('roles')->ignore($this->user)],
        ];


        if ($this->method() != 'PUT' or  $this->method() != 'PATCH') {
            unset($rules['name']);
        }

        return $rules;
    }

    public function createRole()
    {
        $role = Role::create([
            'name' => $this->_name,
            'display_name' => $this->display_name,
        ]);

        if ($this->has('permissions')) {
            $role->givePermissionTo($this->permissions);
        }
    }

    public function updateRole($role)
    {
        $role->update([
            'display_name' => $this->display_name,
        ]);

        $role->permissions()->detach();

        if ($this->has('permissions')) {
            $role->givePermissionTo($this->permissions);
        }
    }



    public function messages()
    {
        return [
            'name.required' => 'El identificador del role es obligatorio',
            'name.unique' => 'El identificador del role ya ha sido registrado',
            'display_name.required' => 'El nombre del role es obligatorio'
        ];
    }
}
