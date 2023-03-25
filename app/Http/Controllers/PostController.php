<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{

    // private  $posts = [
    //     [    'id'=> 1,
    //         'title'=> 'Laravel',
    //         'description' =>'Hello Laravel Desription',
    //         'Posted_by' => 'Raneen',
    //         'Created_by' => '2022-08-01 10:00:00'
    //     ],
    //     [
    //         'id' => 2,
    //         'title' => 'PHP',
    //         'description' =>'Hello PHP Desription',
    //         'Posted_by' => 'Mohamed',
    //         'Created_by' => '2022-08-01 10:00:00'
    //     ],
    //     [
    //         'id' => 3,
    //         'title' => 'Javascript',
    //         'description' =>'Hello Javascript Desription',
    //         'Posted_by' => 'Mahmoud',
    //         'Created_by' => '2022-08-01 10:00:00'
    //     ],

    // ];
    public function index(){
        $allposts = Post::paginate(10);
        return view('post.index', ['posts' => $allposts]);
    }

    public function show($id){
        $post = Post::where('id', $id)->first();
        $comments = $post->comments;
        // dd($comments);
        return view('post.show',["comments"=>$comments],['post' => $post]);
    }

    public function create(){
        //select all users and posts
        $users = User::all();
        // if($posts->user_id == $users->id)
        return view('post.create', ['users'=>$users]);
    }

    public function store(StorePostRequest $request){
        // $data = request()->all();
        // dd($data);
        //store data in variables
        // $title = request()->title;
        // $description = request()->description;
        // $userCreator = request()->post_creator;

        //store variables data in database
        $path = null;
        if ($request->hasFile('image')) /*file field has value*/{
            $path = $request->file('image')->store('posts', ['disk' => "public"]);
        }
        Post::create([
            'title' => request()->title,
            'description' => request()->description,
            'user_id' => request()->post_creator,
            'image' => $path
        ]);
        return redirect()->route('posts.index');
    }
    
    public function edit($id){
        // foreach($this->posts as $post){
        //     if($post['id'] == $id)
        //     return view('post.edit', ['post' => $post]);
        // }
        // return false;
        $post = Post::where('id', $id)->first();
        return view('post.edit', ['post' => $post]);
    }

    public function update(UpdatePostRequest $request, $id){
        // $data = request()->all();
        // dd($data);
        //store data in variables
        // $title = request()->title;
        // $description = request()->description;
        // dd($title, $description);
        $post = post::find($id);
        if ($request->hasFile('image')) /*choose file in file input*/{
            if($post->image) //if already existed image or not
                {
                    Storage::disk("public")->delete($post->image);
                }
            $path = $request->file('image')->store('posts', ['disk' => "public"]);
        }
        else
        {
            $path = $post->image;
        }
        
        $post->update(
            [
                //column name -> came data of name of input
               'title'=> request()->title,
               'description'=> request()->description,
               'image' => $path,
               'slug' => Str::of(request()->title)->slug('-') //for update slug when update title
            
            ]);
            
    return redirect()->route('posts.index');
}

    public function destroy($id){
        $post = Post::where('id', $id)->first();
        if($post->image){
            Storage::disk("public")->delete($post->image);
        }
        $post->delete();
        return redirect()->route('posts.index', $post['user_id'] );
    }
}