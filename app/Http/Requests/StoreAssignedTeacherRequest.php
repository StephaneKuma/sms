<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssignedTeacherRequest extends FormRequest
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
            'section_id' => 'required|integer|gt:0',
            'course_id' => 'required|integer|gt:0',
            'teacher_id' => 'required|integer|gt:0',
        ];
    }
}
