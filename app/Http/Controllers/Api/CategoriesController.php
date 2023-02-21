<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

// use App\Models\Categories;
use App\Models\Categories;

class CategoriesController extends Controller
{
    public function getAllCategories() : JsonResponse
    {
        return response()->json([
            'categories' => Categories::all(),
        ]);
    }

    public function getTopCategories() : JsonResponse
    {
        $categories = Categories::withCount('post')->orderBy('post_count', 'desc')->limit(6)->get();

        return response()->json(
            [
                'top_categories' => $categories,
            ]
        );
    }
}
