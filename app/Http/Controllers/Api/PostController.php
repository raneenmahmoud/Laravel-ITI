<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index()
    {
        $allposts = Post::all();

        return PostResource::collection($allposts);

        // $response =[];
        // foreach($allposts as $post)
        // {
        //     $response [] =
        //     [
        //         'id' => $post->id,
        //         'title' => $post->title,
        //         'decsription' => $post->description
        //     ];
        // }
        // return $response;

        // return $allposts; 
    }
    public function show($id)
    {
        $post = Post::find($id);

        return new PostResource($post);
        // return
        //     [
        //         'id' => $post->id,
        //         'title' => $post->title,
        //         'decsription' => $post->description
        //     ];
        // return $post;
    } 
    public function store(StorePostRequest $request){

        //store variables data in database
        $path = null;
        if ($request->hasFile('image')) /*file field has value*/{
            $path = $request->file('image')->store('posts', ['disk' => "public"]);
        }
        $post = Post::create([
            'title' => request()->title,
            'description' => request()->description,
            'user_id' => request()->post_creator,
            'image' => $path
        ]);
        return new PostResource($post);
        // return
        //     [
        //         'id' => $post->id,
        //         'title' => $post->title,
        //         'decsription' => $post->description
        //     ];
        // return $post;
    }
}
