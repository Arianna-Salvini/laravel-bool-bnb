<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApartmentRequest extends FormRequest
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
            'user_id' => 'nullable|exists:users,id',
            'services' => 'required|array|min:1',//prima definisci la struttura
            'services.*' => 'exists:services,id',//assegno ad ogni elemento dal array
            'description' => 'nullable|max:1000',
            'image' => 'nullable|image|max:1000',
            'rooms' => 'nullable|integer|min:1',
            'beds' => 'nullable|integer|min:1',
            'bathrooms' => 'nullable|integer|min:1',
            'square_meters' => 'nullable|integer|min:1',
            'address' => 'required',
            'street_number' => 'required|regex:/^[a-zA-Z0-9\/]+$/',
            'country_code' => 'required',
            'zip_code' => 'required',
            'city' => 'required',
            'visibility' => 'required|boolean',
        ];
    }
}
