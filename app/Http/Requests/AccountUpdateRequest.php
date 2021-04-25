<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountUpdateRequest extends FormRequest
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
        $applicant = $user->applicant;
        return [
            'name' => 'required|string|max:191',
            'nid' => 'required|unique:applicants,nid,'.$applicant->id,
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'mobile' => 'required|numeric|unique:applicants,mobile,'.$applicant->id,
            'password' => $this->request->get('password') != null ?'sometimes|required|min:6': '',
            // 'username' => $this->request->get('username') != null ?"sometimes|required|min:8|unique:users,username.$user->id": ''
            'username' => 'sometimes|required|min:8|unique:users,username,'.$user->id,
        ];
    }

    public function messages()
{
        return [
            'name.required' => 'Name is required',
            'name.max' => 'More than 191 characters is not acceptable',
            'nid.required' => 'NID number is required',
            'nid.unique' => 'This NID has already been registered',
            'email.required' => 'Email address is required',
            'email.email' => 'Email address is not valid',
            'email.unique' => 'The email address has already been taken',
            'mobile.required' => 'Mobile number is required',
            'mobile.numeric' => 'Mobile number must be a number',
            'mobile.unique' => 'Mobile number has already been taken',
            'password.required' => 'Password is required',
            'username.required' => 'Username is required',
        ];
    }
}
