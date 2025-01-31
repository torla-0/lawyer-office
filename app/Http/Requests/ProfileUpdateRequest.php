<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'firstname' => ['required', 'string', 'max:16'],
            'lastname' => ['required', 'string', 'max:16'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:32', Rule::unique(User::class)->ignore($this->user()->id)],
            'phone_number' => ['required', 'string', 'max:16'],
            'address' => ['required', 'string', 'max:16'],
            'city' => ['required', 'string', 'max:16'],
        ];
    }
}
