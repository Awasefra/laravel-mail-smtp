<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendPayrollBatchEmailRequest extends FormRequest
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
            'division' => 'required',
            'names' => 'required|array',
            'emails' => 'required|array',
            'salaries' => 'required|array',
            'allowances' => 'required|array',
            'subject' => 'required',
            'message' => 'required'
        ];
    }
}
