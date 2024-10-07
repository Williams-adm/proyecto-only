<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class InventoryFilter extends ApiFilter
{
    protected $safeParams = [
        'stockMin' => ['eq', 'lt', 'gt', 'lte', 'gte', 'ne'],
        'stockMax' => ['eq', 'lt', 'gt', 'lte', 'gte', 'ne'],
        'currentStock' => ['eq', 'lt', 'gt', 'lte', 'gte', 'ne'],
        'sellingPrice' => ['eq', 'lt', 'gt', 'lte', 'gte', 'ne'],
        'status' => ['eq', 'ne'],
        'productId' => ['eq'],
        'branch_id' => ['eq'],
    ];
    protected $columnMap = [
        'stockMin' => 'stock_min',
        'stockMax' => 'stock_max',
        'currentStock' => 'current_stock',
        'sellingPrice' => 'selling_price',
        'productId' => 'product_id',
        'branchId' => 'branch_id'
    ];
    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'gt' => '>',
        'lte' => '<=',
        'gte' => '>=',
        'ne' => '!='
    ];
}
