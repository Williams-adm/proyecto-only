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
        'registrationDate' => ['eq', 'lt', 'lte', 'gte', 'ne'],
    ];
    protected $columnMap = [
        'paternalSurname' => 'paternal_surname',
        'maternalSurname' => 'maternal_surname',
        'dateOfBrith' => 'date_of_brith',
    ];
    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gte' => '>=',
        'ne' => '!='
    ];
}