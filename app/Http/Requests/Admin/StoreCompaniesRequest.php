<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompaniesRequest extends FormRequest
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
            'name' => 'required',
            'kvk_number' => 'required',
            'btw_number' => 'required',
            'contact_email' => 'required|email',
            'contact_number' => 'required',
            'location' => 'required',
            'description' => 'required',
        ];
    }
}
