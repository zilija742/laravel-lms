<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
//            'password' => 'required|min:6',
            'gender'              => ['required', 'in:male,female,other'],
//            'image'               => ['required', 'image'],
            'baptism_name' => 'required',
            'birthday' => 'required',
            'birth_place' => 'required',
            'candidate_number' => 'required',
            'driver_license_number' => 'required',
            'driver_license_category' => 'required',
            'driver_card_expire' => 'required',
            'code95_expire' => 'required',
            'vca_number' => 'required',
            'personal_number' => 'required',
        ];
    }
}
