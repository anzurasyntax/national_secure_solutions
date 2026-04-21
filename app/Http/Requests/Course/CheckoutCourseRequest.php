<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutCourseRequest extends FormRequest
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
        return [
            'buyer_name' => ['nullable', 'string', 'max:255'],
            'buyer_email' => ['required', 'email', 'max:255'],
        ];
    }
}
