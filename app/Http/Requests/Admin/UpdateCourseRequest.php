<?php

namespace App\Http\Requests\Admin;

use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCourseRequest extends FormRequest
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
        /** @var Course $course */
        $course = $this->route('course');

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('courses', 'slug')->ignore($course->id)],
            'summary' => ['nullable', 'string', 'max:5000'],
            'description' => ['nullable', 'string', 'max:50000'],
            'price' => ['required', 'numeric', 'min:0'],
            'currency' => ['required', 'string', 'size:3'],
            'is_published' => ['sometimes', 'boolean'],
            'duration_minutes' => ['nullable', 'integer', 'min:1', 'max:99999'],
            'image' => ['nullable', 'image', 'max:5120'],
            'categories_input' => ['nullable', 'string', 'max:4000'],
            'learning_outcomes_input' => ['nullable', 'string', 'max:60000'],
            'faq_sections' => ['nullable', 'array'],
            'faq_sections.*.title' => ['nullable', 'string', 'max:500'],
            'faq_sections.*.body' => ['nullable', 'string', 'max:60000'],
            'material_includes_input' => ['nullable', 'string', 'max:30000'],
            'requirements_input' => ['nullable', 'string', 'max:30000'],
            'audience' => ['nullable', 'string', 'max:60000'],
            'level_label' => ['nullable', 'string', 'max:120'],
            'detail_last_updated_at' => ['nullable', 'date'],
        ];
    }
}
