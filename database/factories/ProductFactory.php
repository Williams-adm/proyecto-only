<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = Category::all()->pluck('id')->toArray();
        $name = strtoupper($this->faker->unique()->words(2, true));
        $code = $this->faker->unique()->ean8();

        $client = new Client();
        $imageUrl = 'https://picsum.photos/720/1080';
        $imageName = 'CoverProduct/' . Str::slug($name . '-' . $code) . '.jpg';

        $response = $client->get($imageUrl);
        Storage::put('public/' . $imageName, $response->getBody());

        return [
            'name' => $name,
            'code' => $code,
            'description' => $this->faker->text(150),
            'usage_recomendation' => $this->faker->text(100),
            'additional_features' => $this->faker->text(100),
            'category_id' => $this->faker->randomElement($category),
            'cover_image_path' => $imageName
        ];
    }
}
