<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class ProductFilter extends ApiFilter
{
    protected $safeParams = [
        'name' => ['eq'],
        'code' => ['eq'],
        'status' => ['eq', 'ne'],
        'categoryId' => ['eq', 'ne']
    ];

    protected $columnMap = [
        'categoryId' => 'category_id',
    ];
    protected $operatorMap = [
        'eq' => '=',
        'ne' => '!='
    ];
}
