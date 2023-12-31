<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'startDate' => 'nullable|date',
            'endDate' => 'nullable|date',
        ];
    }


    // /**
    //  * Get custom messages for validator errors.
    //  *
    //  * @return array
    //  */
    // public function messages()
    // {
    //     return [
    //         'name' => 'error in name',
    //         'description' => 'error in description',
    //         // Add more custom messages as needed
    //     ];
    // }
}
