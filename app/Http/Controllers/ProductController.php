<?php

namespace App\Http\Controllers;

use App\Filters\ProductFilter;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request){
        $filter = new ProductFilter();
        $queryItems = $filter->transform($request);

        $product = Product::where($queryItems);
        return new ProductCollection($product->paginate()->appends($request->query()));
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $data['code'] = $this->generateUniqueCode($data['name']);

        try {
            Product::create($data);
            return response()->json(['message' => "El producto ha sido creado",], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Error al crear el producto: " . $e->getMessage()
            ], 500);
        }
    }

    private function generateUniqueCode(string $name): string
    {
        do {
            $formattedName = strtoupper(substr($name, 0, 3));
            $randomNumber = rand(100, 999);
            $code = $formattedName . $randomNumber;
        } while (Product::where('code', $code)->exists());

        return $code;
    }

    public function show(Product $product){
        return new ProductResource($product);
    }

    public function update(UpdateProductRequest $request, Product $product){
        $product->update($request->all());
        return response()->json(['message' => "El producto con el id {$product->id} ha sido actualizado"], 200);
    }

    public function destroy(Product $product){
        $product->delete();
        return response()->json(['message' => "El producto con el id {$product->id} ha sido eliminado"], 200);
    }
}
