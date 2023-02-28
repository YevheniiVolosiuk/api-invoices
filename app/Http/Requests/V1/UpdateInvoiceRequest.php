<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInvoiceRequest extends FormRequest
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
        $method = $this->method();

        if ($method == "PUT") {
            return [
                'customerId' => ['required'],
                'amount' => ['required'],
                'status' => ['required', Rule::in(['B', 'P', 'V'])],
                'billedDate' => ['required'],
            ];
        } else {
            return [
                'customerId' => ['sometimes', 'required'],
                'amount' => ['sometimes', 'required'],
                'status' => ['sometimes', 'required', Rule::in(['B', 'P', 'V'])],
                'billedDate' => ['sometimes', 'required'],
            ];
        }
    }

    protected function prepareForValidation()
    {
        if (isset($this->customerId) || isset($this->billedDate) || isset($this->paidDate)) {
            $this->merge([
                'customer_id' => $this->customerId,
                'billed_date' => $this->billedDate,
                'paid_date' => $this->paidDate,
            ]);
        }
    }
}
