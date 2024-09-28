<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class CategoryFilter extends ApiFilter
{
    protected $safeParams = [
        'name' => ['eq', 'ne'],
        'status' => ['eq', 'ne'],
    ];
    
    protected $operatorMap = [
        'eq' => '=',
        'ne' => '!='
    ];
}
