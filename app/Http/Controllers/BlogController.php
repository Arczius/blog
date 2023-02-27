<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

use App\Rules\titlePattern;
use App\Rules\descriptionPattern;

use App\Models\Post as Posts;

class BlogController extends Controller
{
    public function getAllBlogs() : JsonResponse
    {   
        return response()->json([
            'blogs' => Posts::all(),
        ]);
    }

    /**
    * store the created post in the database
    *
    * @return 
    */
    public function store(Request $request) : JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', new titlePattern(), 'max:255'],
            'description' => [new descriptionPattern(), 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json($response);
        }

        $blog = new Posts();
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->save();

        $response = [
            'id' => $blog->id
        ];
        
        return response()->json($response);
    }

    /**
    * store the included image in the database
    *
    * @return 
    */
    public function getBlogImage (Request $request, String $id) {
        $validator = Validator::make($request->all(), [
            'coverFile' => ['mimes:png,jpg,jpeg'],
            'file' => ['mimes:png,jpg,jpeg']
        ]);

        $data['status'] = 'failed';

        if ($validator->fails()) {
            return response()->json($response);
        }

        $coverFile = $request->coverFile;
        $file = $request->file;

        $blogPost = Posts::where('id', $id)->first();

        /* stores image in public/blogPictures folder */
        if (isset($coverFile)) {
            $coverFile->store('blogPictures', 'public');
            $file->store('blogPictures', 'public');
        }

        if(isset($coverFile)){
            $fileNameCover = $blogPost->id . "_cover." . $coverFile->extension();
            $fileName = $blogPost->id . "_content." . $file->extension();

            $coverFile->storeAs('public/BlogPictures', $fileNameCover, 'local');
            $file->storeAs('public/BlogPictures', $fileName, 'local');

            Posts::where('id', $blogPost->id)->update([
                'coverFile' => $fileNameCover,
                'file' => $fileName,
            ]);
            $data['status'] = 'success';
        }

        return response()->json($data);
    }


