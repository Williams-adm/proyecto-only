<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class InflowFilter extends ApiFilter
{
    protected $safeParams = [
        'operation' => ['eq'],
        'type_voucher' => ['eq', 'ne'],
        'num_voucher' => ['eq', 'ne'],
    ];

    protected $columnMap = [
        'typeVoucher' => 'type_voucher',
        'numVoucher' => 'num_voucher',
    ];

    protected $operatorMap = [
        'eq' => '=',
        'ne' => '!='
    ];
}
