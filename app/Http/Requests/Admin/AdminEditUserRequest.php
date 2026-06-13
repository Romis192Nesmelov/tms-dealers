<?php

namespace App\Http\Requests\Admin;

use App\Http\Controllers\HelperTrait;
use Illuminate\Foundation\Http\FormRequest;
use function request;

class AdminEditUserRequest extends FormRequest
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
            'email' => $this->validationEmail.'|unique:users,email',
            'is_admin' => 'integer|min:0|max:1'
        ];

        if (request()->has('id')) {
            $rules['id'] = $this->validationUserId;
            $rules['email'] .= ','.request('id');
            if (request('password')) $rules['password'] = $this->validationPassword.'|confirmed';
        } else {
            $rules['password'] = $this->validationPassword.'|confirmed';
        }
        return $rules;
    }
}
