<?php

namespace App\Http\Requests\client\ticket;

use Illuminate\Foundation\Http\FormRequest;

class CreateAnonymousTicketRequest extends FormRequest
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
            'email' => 'required|max:50|email:rfc,dns',
            'title' => 'required|max:50',
            'text' => 'required|max:300',
        ];
    }
}
