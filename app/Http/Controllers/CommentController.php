<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(Request $request, $id){
        
        $post = Post::where('id', $id)->first();
        $comment = request()->comment;
        $post->comments()->create([
            'comment' => $comment,
        ]);;
        return redirect()->back();
    }
}
