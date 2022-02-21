<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeStoreRequest extends FormRequest
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
            'email' => ['string','max:255','required','unique:employees'],
            'address' => ['string','max:255','required'],
            'first_name' => ['string','max:255','required'],
            'last_name' => ['string','max:255','required'],
            'other_name' => ['string','max:255','required'],
            'department_id' => ['required'],
            'country_id' => ['required'],
            'state_id' => ['required'],
            'city_id' => ['required'],
            'zip_code' => ['string','max:255','required'],
            'birthdate' => ['required'],
            'date_hired' => ['required'],
        ];
    }
}
