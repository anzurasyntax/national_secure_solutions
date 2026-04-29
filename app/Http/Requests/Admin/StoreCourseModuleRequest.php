<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseModuleRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'duration_minutes' => ['nullable', 'integer', 'min:1', 'max:99999'],
            'body' => ['nullable', 'string', 'max:50000'],
            'lesson_outline_input' => ['nullable', 'string', 'max:60000'],
            'material_files' => ['nullable', 'array'],
            'material_files.*' => [
                'file',
                'max:204800',
                'mimes:mp4,webm,ogv,ogg,mov,avi,mkv,ppt,pptx,jpg,jpeg,png,gif,webp',
            ],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:999999'],
        ];
    }
}
