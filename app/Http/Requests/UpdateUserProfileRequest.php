<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'zip_code' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'sname' => 'required|string|max:255',
            'semail' => 'required|string|email|max:255',
            'scity' => 'required|string|max:255',
            'saddress' => 'required|string|max:255',
            'szip_code' => 'required|string|max:255',
            'location' => 'required|string|max:255'
        ];
    }
}
