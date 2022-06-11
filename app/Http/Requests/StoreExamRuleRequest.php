<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExamRuleRequest extends FormRequest
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
            'total_mark' => 'required|integer',
            'pass_mark' => 'required|integer',
            'note' => 'sometimes|nullable|string',
            'session_id' => 'required|integer|gt:0',
            'exam_id' => 'required|integer|gt:0',
        ];
    }
}
