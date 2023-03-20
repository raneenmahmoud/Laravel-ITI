<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

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
        $users = User::all();
        // dd($comments);
        return view('post.show',["comments"=>$comments],['post' => $post]);
    }

    public function create(){
        //select all users and posts
        $users = User::all();
        // if($posts->user_id == $users->id)
        return view('post.create', ['users'=>$users]);
    }

    public function store(Request $request){
        $data = request()->all();
        // dd($data);
        //store data in variables
        $title = request()->title;
        $description = request()->description;
        $userCreator = request()->post_creator;

        //store variables data in database
        Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $userCreator
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

    public function update(Request $request, $id){
        $data = request()->all();
        // dd($data);
        //store data in variables
        $title = request()->title;
        $description = request()->description;
        // dd($title, $description);
        $post = post::find($id);
        $post->update(
            [
                //column name -> came data of name of input
               'title'=> $title,
               'description'=> $description,
            
            ]);
        return redirect()->route('posts.index');
    }

    public function destroy($id){
        $post = Post::where('id', $id)->first();
        $post->delete();
        return redirect()->route('posts.index', $post['user_id'] );
    }
}