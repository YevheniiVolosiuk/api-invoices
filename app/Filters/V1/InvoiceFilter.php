<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class InvoiceFilter extends ApiFilter
{
    protected array $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
        'ne' => '!=',
    ];

    protected array $allowedParms = [
        'customer_id' => ['eq'],
        'amount' => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'status' => ['eq', 'ne'],
        'billed_date' => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'paid_date' => ['eq', 'lt', 'gt', 'lte', 'gte'],
    ];

    protected array $columnMap = [
        'customerId' => 'customer_id',
        'billed_date' => 'billed_date',
        'paidDate' => 'paid_date',
        'status' => 'status',
    ];


}
