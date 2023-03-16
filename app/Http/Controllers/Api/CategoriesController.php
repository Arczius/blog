<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\JsonResponse;

use App\Models\Categories;

class CategoriesController extends Controller
{
    /**
    * get all the categories from the database
    *
    * @return
    */
    public function getAllCategories() : JsonResponse
    {
        return response()->json([
            'categories' => Categories::all(),
        ]);
    }

    /**
    * get the top categories
    *
    * @return
    */
    public function getTopCategories() : JsonResponse
    {
        $categories = Categories::withCount('post')->orderBy('post_count', 'desc')->limit(6)->get();

        return response()->json(
            [
                'top_categories' => $categories,
            ]
        );
    }

    public function getCategoriesByAmount(String $amount)
    {
        return response()->json([
            'categories' => Categories::limit($amount)->get()
        ]);
    }
}
