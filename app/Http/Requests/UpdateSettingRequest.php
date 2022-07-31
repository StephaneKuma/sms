<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
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
            'name' => 'sometimes|nullable|string|max:255',
            'establish_date' => 'sometimes|nullable|date',
            'address' => 'sometimes|nullable|string|max:255',
            'email' => 'sometimes|nullable|string|email|max:255',
            'phone' => 'sometimes|nullable|string|regex:/^([0-9\s\-\+\(\)]*)$/|max:255',
            'phone2' => 'sometimes|nullable|string|regex:/^([0-9\s\-\+\(\)]*)$/|max:255',
            'fax' => 'sometimes|nullable|string|regex:/^([0-9\s\-\+\(\)]*)$/|max:255',
            'logo' => 'sometimes|nullable|string|max:255',
            'attendance_type' => 'sometimes|nullable|string|max:255',
            'mark_submission_status' => 'sometimes|nullable|string|max:255',
        ];
    }
}
