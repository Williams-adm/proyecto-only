<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class CustomerBusinessFilter extends ApiFilter
{
    protected $safeParams = [
        'businessName' => ['eq'],
        'fiscalAddress' => ['eq'],
        'registrationDate' => ['eq', 'lt', 'lte', 'gte', 'ne'],
    ];
    protected $columnMap = [
        'businessName' => 'business_name',
        'fiscalAddress' => 'fiscal_address',
        'registrationDate' => 'registration_date'
    ];
    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gte' => '>=',
        'ne' => '!='
    ];
}