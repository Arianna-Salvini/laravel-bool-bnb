<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApartmentRequest extends FormRequest
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
            'title' => 'required|min:5|max:255',
            'user_id' => 'nullable|exists:user,id',
            'services' => 'exists:services,id',
            'description' => 'nullable|max:1000',
            'image' => 'nullable|image|max:1000',
            'rooms' => 'nullable|integer|min:1',
            'beds' => 'nullable|integer|min:1',
            'bathrooms' => 'nullable|integer|min:1',
            'square_meters' => 'nullable|integer',
            'address' => 'nullable',
            'street_number' => 'nullable',
            'country_code' => 'nullable',
            'zip_code' => 'nullable',
            'city' => 'nullable',
            'visibility' => 'required|boolean',
        ];
    }
}
