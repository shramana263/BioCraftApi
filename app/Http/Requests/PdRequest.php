<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PdRequest extends FormRequest
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
        return [
            'fname'=> 'required',
            'lname'=>'required',
            'gender'=>'required',
            'address'=>'required',
            'contact_no'=>'required',
            'dob'=>'required',
            'country'=>'required',
        ];
    }
}
