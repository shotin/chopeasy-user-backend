<?php

namespace App\Http\Controllers\v1\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class RecipeController extends Controller
{

    public function index()
    {

        $response = Http::withToken(config('services.inventory.api_token'))
            ->get(config('services.inventory.url') . '/retail/recipes');

        if (!$response->successful()) {
            return response()->json(['error' => 'Failed to fetch recipe'], $response->status());
        }

        $recipe = collect($response->json()['recipes'] ?? []);

        return response()->json([
            'recipe' => $recipe->values(),
        ]);
    }

    public function getRecipeIngredients($id)
    {
        $url = config('services.inventory.url') . "/retail/recipes/{$id}/ingredients";

        try {
            $response = Http::withToken(config('services.inventory.api_token'))->get($url);

            if (!$response->successful()) {
                return response()->json(['error' => 'Failed to fetch ingredients'], $response->status());
            }

            $ingredients = collect($response->json()['ingredients'] ?? []);

            return response()->json([
                'ingredients' => $ingredients->values(),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong while retrieving recipe ingredients.'
            ], 500);
        }
    }

    public function getFilteredRecipeIngredients(Request $request, $id)
    {
        $queryParams = $request->only([
            'unit_ids',
            'category_id',
            'price_min',
            'price_max',
            'search'
        ]);

        $response = Http::withToken(config('services.inventory.api_token'))
            ->get(config('services.inventory.url') . "/retail/recipes/{$id}/ingredients/filter", $queryParams);

        if (!$response->successful()) {
            return response()->json(['error' => 'Failed to fetch filtered ingredients'], $response->status());
        }

        return response()->json([
            'ingredients' => $response->json('ingredients') ?? [],
        ]);
    }
}
