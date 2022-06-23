<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('edit users');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['sometimes', 'nullable', 'confirmed', Rules\Password::defaults()],
            'gender' => 'sometimes|nullable|string|max:255',
            'blood_type' => 'sometimes|nullable|string|max:255',
            'nationality' => 'sometimes|nullable|string|max:255',
            'phone' => 'sometimes|nullable|string|max:255',
            'address' => 'sometimes|nullable|string|max:255',
            'address2' => 'sometimes|nullable|string|max:255',
            'city' => 'sometimes|nullable|string|max:255',
            'zip' => 'sometimes|nullable|string|max:255',
            'picture' => 'sometimes|nullable|image',
            'birthday' => 'sometimes|nullable|date',
            'religion' => 'sometimes|nullable|string|max:255',
            'role' => 'required|integer|gt:0',
        ];
    }
}
