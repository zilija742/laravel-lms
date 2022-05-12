<?php

namespace App\Http\Requests\Admin;

use App\Helpers\Auth\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreAgendasRequest extends FormRequest
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
        return [
            'company_id' => 'required',
            'course_id' => 'required',
            'location_id' => 'required',
            'user_id' => 'required',
            'student_quantity' => 'required',
        ];
    }
}
