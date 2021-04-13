<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
        $user = auth()->user();
        $employee = $user->employee;
        return [
            'name' => 'required|string|max:191',
            'designation' => 'required|string|max:191',
            'department' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'mobile' => 'required|numeric|min:11|unique:employees,mobile,'.$employee->id,
            'password' => $this->request->get('password') != null ?'sometimes|required|min:6': ''
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Employee name is required',
            'name.max' => 'More than 191 characters is not acceptable',
            'designation.required' => 'Employee designation is required',
            'designation.max' => 'More than 191 characters is not acceptable',
            'department.required' => 'Employee department is required',
            'department.max' => 'More than 191 characters is not acceptable',
            'email.required' => 'Employee email address is required',
            'email.email' => 'Email address is not valid',
            'email.unique' => 'The email address has already been taken',
            'mobile.required' => 'Employee mobile number is required',
            'mobile.numeric' => 'Mobile number must be a number',
            'mobile.min' => 'Mobile number must be 11 digits',
            'mobile.unique' => 'Mobile number has already been taken',
            'password.required' => 'Employee password is required',
        ];
    }
}
