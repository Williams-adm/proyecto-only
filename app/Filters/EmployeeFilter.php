<?php

namespace App\Filters;
use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class EmployeeFilter extends ApiFilter
{
    protected $safeParams = [
        'name' => ['eq'],
        'paternalSurname' => ['eq'],
        'maternalSurname' => ['eq'],
        'dateOfBrith' => ['eq', 'lt', 'lte', 'gte', 'ne'],
        'salary' => ['eq', 'lt', 'lte', 'gte', 'ne'],
        'paymentDate' => ['eq']
    ];
    protected $columnMap = [
        'paternalSurname' =>'paternal_surname',
        'maternalSurname' =>'maternal_surname',
        'dateOfBrith' => 'date_of_brith',
        'paymentDate' =>'payment_date'
    ];
    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gte' => '>=',
        'ne' => '!='   
    ]; 
}
