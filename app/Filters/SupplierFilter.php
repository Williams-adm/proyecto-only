<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class SupplierFilter extends ApiFilter
{
    protected $safeParams = [
        'numRuc' => ['eq'],
        'businessName' => ['eq'],
        'fiscalAddress' => ['eq'],
        'phone' => ['eq'],
        'contac' => ['eq'],
        'status' => ['eq', 'ne'],
    ];
    protected $columnMap = [
        'numRuc' => 'num_ruc',
        'businessName' => 'business_name',
        'fiscalAddress' => 'fiscal_address',
    ];
    protected $operatorMap = [
        'eq' => '=',
        'ne' => '!='
    ];
}
