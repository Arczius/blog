<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

use App\Rules\titlePattern;
use App\Rules\descriptionPattern;

use App\Models\Posts;
use App\Models\Comments;
use App\Models\PostsComments;

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

        /* give the uploaded file a new name and store it */ 
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

    
    /**
    * delete the blog from the database
    *
    * @return
    */
    public function destroy (String $id) : JsonResponse 
    {
        $blog = Posts::find($id);
        if($blog){
            $blog->delete();
            return response()->json([ 'status' => 200, 'message' => 'Blog deleted successfully', ], 200);
        }else{
            return response()->json([ 'status' => 404, 'message' => 'No blog found' ], 404);
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
    * get the current the blog data
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
    * add a comment to the selected blog
    * 
    */
    public function addComment(Request $request, String $id)
    {
        $validator = Validator::make($request->all(), [
            'comment' => ['required'],
        ]);

        $comment = new Comments();
        $comment->comment = $request->comment;
        $comment->save();

        // $postComment = new PostsComments();
        // $postComment->post_id = $id;
        // $postComment->save();

        $response = [
            'id' => $comment->id
        ];

        if ($validator->fails()) {
            return response()->json($response);
        }

        return response()->json($response);
    }

    /**
    * get all the blogs which belongs to a blog
    * 
    */
    public function getAllComments(){
        return response()->json(
            [
                'comments' => PostsComments::all(),
            ]

            // postComments -> comment_id / user_id
            // comments -> comment
            // users -> profile_picture
        );
    }
}
