<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
        $rules =  [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'string', 'max:50', Rule::unique('users')->ignore($this->user)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user)],
            //  'departments'=>['required'],
            //  'roles' =>['required']
        ];


        if ($this->filled('password')) {
            $rules['password'] = ['confirmed', 'min:6'];
        }

        return $rules;
    }

    /**
     * @param $user
     */
    public function updateUser($user)
    {
        $user->fill([
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
        ]);

        if ($this->password != null) {
            $user->password = $this->password;
        }
        $user->save();

        //Update Roles
        //   $user->roles()->sync($this->roles);

        //Update Departments
        //  $user->departments()->sync($this->departments);

    }
}
