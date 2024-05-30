<?php

namespace App\Http\Requests\Web;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {   
        $id = intval($this->usuario);
        $rules = [];
        if (empty($id)) {
            $rules =  [
                'name' => ['required', 'min:3', 'max:50', 'string'],
                'email' => ['required', 'max:70', 'email', 'unique:users,email'],
                'password' => ['required', 'min:6', 'max:20', 'confirmed']
            ];
        } else {
            if ($this->name) {
                $name = ['required', 'min:3', 'max:50', 'string'];
                $rules['name'] = $name;
            }
            if ($this->email) {
                $email = ['required', 'max:70', 'email', 'unique:users,email,' . $id];
                $rules['email'] = $email;
            }
            if ($this->password) {
                $password = ['required', 'min:6', 'max:20', 'confirmed'];
                $rules['password'] = $password;
            }
        }
        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        toastr($validator->errors()->first(),'warning',[],'Aviso');
        throw (new ValidationException($validator))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
