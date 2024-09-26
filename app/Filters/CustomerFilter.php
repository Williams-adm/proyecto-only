<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class CustomerFilter extends ApiFilter
{
    protected $safeParams = [
        'name' => ['eq'],
        'paternalSurname' => ['eq'],
        'maternalSurname' => ['eq'],
        'dateOfBrith' => ['eq', 'lt', 'lte', 'gte', 'ne'],
        'business_name' => ['eq'],
        'fiscal_address' => ['eq']
    ];
    protected $columnMap = [
        'paternalSurname' => 'paternal_surname',
        'maternalSurname' => 'maternal_surname',
        'dateOfBrith' => 'date_of_brith',
        'businessName' => 'business_name',
        'fiscalAddress' => 'fiscal_address'
    ];
    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gte' => '>=',
        'ne' => '!='
    ];
}