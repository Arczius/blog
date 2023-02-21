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
}
