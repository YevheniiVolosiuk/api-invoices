<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BulkStoreCustomerRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            '*.firstName' => ['required'],
            '*.lastName' => ['nullable'],
            '*.type' => ['required', Rule::in(['I', 'B', 'i', 'b'])],
            '*.email' => ['required', 'email'],
            '*.phone' => ['required'],
            '*.address' => ['required'],
            '*.city' => ['required'],
            '*.state' => ['required'],
            '*.postalCode' => ['required'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $data = [];

        foreach ($this->toArray() as $obj){
            $obj['first_name'] = $obj['firstName'] ?? NULL;
            $obj['last_name'] = $obj['lastName'] ?? NULL;
            $obj['postal_code'] = $obj['postalCode'] ?? NULL;

            $data[] = $obj;
        }

        $this->merge($data);
    }
}
