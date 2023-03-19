<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{

    private  $posts = [
        [    'id'=> 1,
            'title'=> 'Laravel',
            'description' =>'Hello Laravel Desription',
            'Posted_by' => 'Raneen',
            'Created_by' => '2022-08-01 10:00:00'
        ],
        [
            'id' => 2,
            'title' => 'PHP',
            'description' =>'Hello PHP Desription',
            'Posted_by' => 'Mohamed',
            'Created_by' => '2022-08-01 10:00:00'
        ],
        [
            'id' => 3,
            'title' => 'Javascript',
            'description' =>'Hello Javascript Desription',
            'Posted_by' => 'Mahmoud',
            'Created_by' => '2022-08-01 10:00:00'
        ],

    ];
    public function index(){

        return view('post.index', ['posts' => $this->posts]);
    }

    public function show($id){

        foreach($this->posts as $post){
            if($post['id'] == $id)
            return view('post.show', ['post' => $post]);
        }
        return false;
    }

    public function create(){
        return view('post.create');
    }

    public function store(){
        return redirect()->route('posts.index');
    }
    
    public function edit($id){
        foreach($this->posts as $post){
            if($post['id'] == $id)
            return view('post.edit', ['post' => $post]);
        }
        return false;
    }
    public function update(){
        return redirect()->route('posts.index');
    }
}