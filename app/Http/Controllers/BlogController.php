<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Rules\titlePattern;
use App\Rules\descriptionPattern;

use App\Models\Post;

use Carbon\Carbon;


class BlogController extends Controller
{
    /**
    * Redirect back to the home page
    *
    * @return view  
    */
    protected function homePage() : View
    {
        return view('home');
    }

    /**
    * store the created post in the database
    *
    * @return 
    */
    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required', new titlePattern(), 'max:255',
            'description' => new descriptionPattern(), 'max:255',
            'picture' => 'mimes:jpeg,png,jpg'
        ]);

        $title = $validated['title'];
        $description = $validated['description'];
        $file = isset($validated['picture']) ? $validated['picture']: null;

        $file = $request->file('picture');

        $blog = [
            "title" =>  $request->title,
            "description" => $request->description,
            "has_image_file" => isset($file),
            "image_file_type" => isset($file) ? $file->extension() : null,
        ];

        Post::insert($blog);

        if(isset($file)){
            $fileName = $blog->id . "." . $file->extension();

            $file->storeAs('public/blogPictures', $fileName, 'local');
        }
        
        return response()->json(['status' => 'broodje']);
    }
}