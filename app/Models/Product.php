<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "code",
        "description",
        "usage_recomendation",
        "additional_features",
        "category_id",
        "status"
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => ucwords($value),
            set: fn(string $value) => strtolower($value),
        );
    }

    protected function coverImagePath(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Storage::url($value),
        );
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function branches(){
        /* relacion de n a n */
        return $this->belongsToMany(Branch::class, 'inventory')->withPivot('stock_min', 'stock_max', 'current_stock', 'selling_price',
        'status')->withTimestamps();
    }

    public function details(){
        return $this->belongsToMany(Detail::class, 'detail_value')->withPivot('id', 'value')
        ->withTimestamps();
    }
}
