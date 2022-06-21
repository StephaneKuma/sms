<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGradeRuleRequest extends FormRequest
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
            'mark' => 'required|integer',
            'grade' => 'required|string',
            'start_at' => 'required|integer',
            'end_at' => 'required|integer',
            'session_id' => 'required|integer|gt:0',
            'system_id' => 'required|integer|gt:0',
        ];
    }
}
