<?php

namespace App\Http\Requests\Admin;

use App\Http\Controllers\HelperTrait;
use Illuminate\Foundation\Http\FormRequest;
use function request;

class AdminEditDealerRequest extends FormRequest
{
    use HelperTrait;

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
        $rules = [
            'address' => $this->validationString.'|unique:dealers,address',
            'latitude' => $this->validationNumeric,
            'longitude' => $this->validationNumeric,
            'name' => $this->validationString,
            'contact' => $this->validationString,
            'phone' => $this->validationString,
            'mail' => $this->validationString,
            'site' => 'nullable|min:1|max:191',
            'active' => 'integer|min:0|max:1',
            'city_id' => 'required|integer|exists:cities,id'
        ];

        if (request()->has('id')) {
            $rules['id'] = 'required|integer|exists:dealers,id';
            $rules['address'] .= ','.request('id');
        }
        return $rules;
    }
}
