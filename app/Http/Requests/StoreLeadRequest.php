<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreLeadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        $this->merge([
            'created_by' => auth()->id()
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           'name' => 'required|string|max:255',
           'email' => 'required|email|unique:leads,email',
           'phone' => 'required|string|max:13|unique:leads,phone',
           'company_name' => 'required|string|max:50',
           'status' => 'required|in:new,contacted,converted,lost',
           'source' => 'required|in:website,referral,social_media,cold_call,other',
           'assigned_to' => 'nullable|exists:users,id',
           'notes' => 'nullable|string|max:100',
           'created_by' => 'required|exists:users,id',
           'timestamps' => 'nullable|date_format:Y-m-d H:i:s'
        ];
    }
}
