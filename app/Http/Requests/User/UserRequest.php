<?php

namespace App\Http\Requests\User;

use App\Events\UserWasCreated;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class UserRequest extends FormRequest
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
            'username' => ['required', 'string', 'max:50', Rule::unique('users')->ignore($this->user)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user)],
        ];

        if ($this->method() != 'PUT' or  $this->method() != 'PATCH') {

            if ($this->filled('password')) {
                $rules['password'] = ['confirmed', 'min:6'];
            }
        }

        return $rules;
    }


    public function createUser()
    {
        $user = new User();

        $user->fill([
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => $password = Str::random(8),
        ]);

        $user->save();

        if ($this->filled('roles')) {
            $user->assignRole($this->roles);
        }

        if ($this->filled('permissions')) {
            $user->givePermissionTo($this->permissions);
        }

        UserWasCreated::dispatch($user, $password);
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
    }
}
