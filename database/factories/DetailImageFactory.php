<?php

namespace Database\Factories;

use App\Models\DetailValue;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetailImage>
 */
class DetailImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected static $productID = [];
    protected static $colorID = [];

    public function definition(): array
    {
        $product = Product::all()->pluck('id')->toArray();
        if (empty(self::$productID)) {
            self::$productID = $product;
        }
        $productID = array_shift(self::$productID);
        
        $color = DetailValue::where('detail_id', 1)->pluck('id')->toArray();
        if (empty(self::$colorID)) {
            self::$colorID = $color;
        }
        $colorID = array_shift(self::$colorID);
        
        $productSearch = Product::find($productID);
        $colorSearch = DetailValue::find($colorID);
        
        $client = new Client();
        $imageUrl = 'https://picsum.photos/400/200';
        $producName = $productSearch->name;
        $colorValue = $colorSearch->value;

        $imageName = 'ImgProductValue/' . Str::slug($producName . '-' . $colorValue) . '.jpg';
        $response = $client->get($imageUrl);
        Storage::put('public/' . $imageName, $response->getBody());

        return [
            'path' => $imageName,
            'detail_value_id' => $colorID
        ];
    }
}
