<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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
        $rules = [];
        if (empty(intval($this->route()->parameter("user")))) {
            $rules =  [
                'name' => ['required', 'min:3', 'max:50', 'string'],
                'email' => ['required', 'max:70', 'email', 'unique:users,email'],
                'password' => ['required', 'min:6', 'max:20', 'confirmed']
            ];
        } else {
            if ($this->request->has('name')) {
                $name = ['required', 'min:3', 'max:50', 'string'];
                $rules['name'] = $name;
            }
            if ($this->request->has('email')) {
                $email = ['required', 'max:70', 'email', 'unique:users,email'];
                $rules['email'] = $email;
            }
            if ($this->request->has('password')) {
                $password = ['required', 'min:6', 'max:20', 'confirmed'];
                $rules['password'] = $password;
            }

        }
        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['message' => $validator->errors()], 422));
    }
}
