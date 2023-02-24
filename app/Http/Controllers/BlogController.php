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
            'file' => ['mimes:png,jpg,jpeg']
        ]);

        if ($validator->fails()) {
            return response()->json($data);
        }

        $file = $request->file;

        $blogPost = Posts::where('id', $id)->first();

        $data['status'] = 'failed';

        /* stores image in public/blogPictures folder */
        if (isset($file)) {
            $file->store('blogPictures', 'public');
        }

        if(isset($file)){
            $fileName = $blogPost->id . "." . $file->extension();
            $file->storeAs('public/BlogPictures', $fileName, 'local');
            Posts::where('id', $blogPost->id)->update([
                'file' => $fileName,
            ]);
            $data['status'] = 'success';
        }

        return response()->json($data);
    }

    /**
    * delete the blog from the database
    *
    * @return 
    */
    public function destroy (Request $request, String $id) : JsonResponse
    {
        $blog = Posts::where('id', $id)->first();

        $file = $blog->file;
        Storage::disk('public')->delete("blogPictures/" . $file);  

        $blog->delete();

        return response()->json($response);
    }
}