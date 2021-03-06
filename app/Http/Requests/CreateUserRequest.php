<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Access\AuthorizationException;

class CreateUserRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('Create User');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'=> 'required|min:1',
            'last_name' => 'required|min:1',
            'email'     => 'required|unique:users,email',
            'password'  => 'required|min:6',
            'role'      => 'required'
        ];
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException(__('api.user.unauthorized.create'));
    }
}
