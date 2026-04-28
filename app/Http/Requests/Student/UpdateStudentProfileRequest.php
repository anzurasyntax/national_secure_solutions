<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $user = $this->user();

        return [
            'first_name' => ['required', 'string', 'max:120'],
            'last_name' => ['required', 'string', 'max:120'],
            'username' => [
                'nullable',
                'string',
                'max:60',
                'regex:/^[a-zA-Z0-9_-]+$/',
                Rule::unique('users', 'username')->ignore($user?->id),
            ],
            'phone' => ['nullable', 'string', 'max:40'],
            'skill_occupation' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:10000'],
            'timezone' => ['nullable', 'string', 'max:64'],
            'public_display_name' => ['nullable', 'string', 'max:255'],
            'avatar' => ['nullable', 'image', 'max:4096'],
            'cover' => ['nullable', 'image', 'max:8192'],
        ];
    }
}
