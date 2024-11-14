<?php

namespace App\Http\Controllers;

use App\Exceptions\ConnectionException;
use App\Exceptions\InvalidFilterException;
use App\Filters\CategoryFilter;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index(Request $request){
        
        try{
            $filter = new CategoryFilter();
            $queryItems = $filter->transform($request);
    
            $perPage = $request->get('per_page', 15);
            /* validacion para la cantidad que debe enviar el dato */
            if(!is_numeric($perPage) || $perPage <= 0){
                return response()->json(['error' => 'El valor de "per_page" debe ser un número mayor que 0.'], 400);
            }
    
            $category = Category::where($queryItems)
                ->paginate($perPage)
                ->appends($request->query());

            if ($category->isEmpty()) {
                return response()->json(['message' => 'No se encontraron categorías.'], 404);
            }
            
            return new CategoryCollection($category);

        } catch (ConnectionException $e){
            Log::error('Error de conexión: ' . $e->getMessage());
            return response()->json(['error' => 'Error de conexión. Por favor, inténtelo más tarde.'], 503);

        } catch (InvalidFilterException $e) {
            Log::error('Filtro inválido: ' . $e->getMessage());
            return response()->json(['error' => 'Filtro Invalido'], 400);

        } catch (QueryException $e) {
            Log::error('Error en la consulta de categorías: ' . $e->getMessage());
            return response()->json(['error' => 'Error al obtener las categorías.'], 500);
            
        } catch (Exception $e) {
            Log::error('Error inesperado: ' . $e->getMessage());
            return response()->json(['error' => 'Error inesperado.'], 500);
        }
    }

    public function store(StoreCategoryRequest $request){
        Category::create($request->all());
        return response()->json(['message' => "La categoria a sido creada"], 201);
    }

    public function show(Category $category){
        return new CategoryResource($category);
    }

    public function update(UpdateCategoryRequest $request, Category $category){
        $category->update($request->all());
        return response()->json(['message' => "La categoria con el id {$category->id} ha sido actualizado"], 200);
    }

    public function destroy(Category $category){
        $category->delete();
        return response()->json(['message' => "La category con el id {$category->id} ha sido eliminado"], 200);
    }
}
