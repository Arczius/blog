<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\Validator;

use App\Rules\titlePattern;
use App\Rules\descriptionPattern;

use App\Models\Posts;
use App\Models\Comments;

use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
    * get all the existing blogs for the home page
    *
    * @return
    */
    public function getAllBlogs() : JsonResponse
    {
        return response()->json([
            'blogs' =>
                Posts::with(['user', 'comments.user'])->get()
        ]);
    }

    /**
    * get all the existing blogs a specific user has made for the personal profile
    *
    * @return
    */
    public function getUserBlogs(String $id) : JsonResponse
    {
        return response()->json([
            'blogs' =>
                Posts::where('user_id', $id)->with(['user', 'comments.user'])->get()
        ]);
    }

    /**
    * store the created post in the database
    *
    * @return
    */
    public function store (Request $request) : JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', new titlePattern(), 'max:255'],
            'description' => [new descriptionPattern(), 'max:255'],
            'user_id' => ['required']
        ]);

        $blog = new Posts();
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->user_id = $request->user_id;
        $blog->save();

        $response = [
            'id' => $blog->id
        ];

        if ($validator->fails()) {
            return response()->json($response);
        }

        return response()->json($response);
    }

    /**
    * store the included images in the database
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
            return response()->json($data);
        }

        $coverFile = $request->coverFile;
        $file = $request->file;

        $blogPost = Posts::where('id', $id)->first();

        /* give the uploaded file a new name and store it */
        if(isset($coverFile) && isset($file)){
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

        if ($validator->fails()) {
            return response()->json($data);
        }

        return response()->json($data);
    }

    /**
    * delete the blog from the database
    *
    * @return
    */
    public function destroy (String $id) : JsonResponse
    {
        $blog = Posts::find($id);
        if($blog){
            foreach ($blog->comments as $comments) {
                $comments->delete();
            }

            $blog->delete();
            /* delete the file from the public folder */
            Storage::disk('public')->delete(
                $blog->coverFile,
                $blog->file
            );

            return response()->json([ 'status' => 200, 'message' => 'Blog deleted successfully', ], 200);
        }else{
            return response()->json([ 'status' => 404, 'message' => 'No blog found' ], 404);

            /* delete the images from the public folder */
            Storage::disk('public')->delete("BlogPictures/" . $blog['coverFile']);
            Storage::disk('public')->delete("BlogPictures/" . $blog['file']);

            $response = [
                'id' => $blog->id
            ];

            return response()->json($response);
        }
    }

    /**
    * delete the blog comment from the database
    *
    * @return
    */
    public function destroyComment (String $id) : JsonResponse
    {
        $comment = Comments::find($id);

        if($comment){
            $comment->delete();

            $response = [
                'id' => $comment->id
            ];

            return response()->json($response);
        }
    }

    /**
    * edit the blog
    *
    * @return
    */
    public function edit (Request $request, String $id)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'numeric'],
            'title' => ['required', new titlePattern(), 'max:255'],
            'description' => [new descriptionPattern(), 'max:255'],
        ]);

        $blog = Posts::find($id);

        if($blog){
            $data = $request->validate([
                'title' => '',
                'description' => '',
            ]);

            $input = $request->all();
            $blog->update($input);

            $response = [
                'id' => $id
            ];

            return response()->json($response);
        }
    }

    /**
    * get one existing blog for the detail page
    *
    * @return
    */
    public function getBlogDetail(String $id) : JsonResponse
    {
        $blog = Posts::where('id', $id)->first();

        return response()->json([
            'blog' => $blog,
            'user' => $blog->user,
        ]);
    }

    /**
    * get the current blog data
    *
    * @return
    */
    public function getCurrentBlogInfo(String $id)
    {
        return response()->json(
            [
                'blog' => Posts::select('id', 'title', 'description')->where('id', $id)->first(),
            ]
        );
    }

    /**
    * add a comment to the blog
    *
    */
    public function addComment(Request $request)
    {
        $validated = $request->validate([
            'comment' => ['required'],
            'user_id' => ['required'],
            'posts_id' => ['required']
        ]);

        $comment = new Comments;
        $comment->comment = $validated['comment'];
        $comment->user_id = $validated['user_id'];
        $comment->posts_id = $validated['posts_id'];
        $comment->save();

        return response()->json(['id' => $comment->id], 201);
    }
}
