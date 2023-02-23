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

use Carbon\Carbon;


class BlogController extends Controller
{
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
            return response()->json($data);
        }

        $blog = new Posts();
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->save();

        // $response['id'] = $blog->id;
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
    public function getBlogImage (Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'file' => ['mimes:png,jpg,jpeg']
        ]);

        if ($validator->fails()) {
            return response()->json($data);
        }

        $file = $request->file;

        $blogPost = Posts::where('id', $id)->get();

        $data['status'] = 'failed';

        if(isset($file)){
            if($blogPost->has_image_file){
                Storage::disk('public')->delete('public/BlogPictures/' . $blogPost->id . "." . $blogPost->blogPost_file_type );
            }

            $fileName = $blogPost->id . "." . $file->extension();
            $file->storeAs('public/BlogPictures', $fileName, 'local');
            blogPosts::where('id', $blogPost->id)->update([
                'has_image_file' => true,
                'blogPost_file_type' => $file->extension(),
            ]);
            $data['status'] = 'success';
        }

        return response()->json($data);
    }
}