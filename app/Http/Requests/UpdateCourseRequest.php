<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'session_id' => 'required|integer|gt:0',
            'semester_id' => 'required|integer|gt:0',
            'class_id' => 'required|integer|gt:0',
            'name' => 'required|string|max:30',
            'type' => 'required|string|max:30',
        ];
    }
}
