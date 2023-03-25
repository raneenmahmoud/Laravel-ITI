<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function(){

    //show all posts
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

    //create new post
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    
    //remove post
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    //show specific post
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

    //update specific post
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');

    //for comments
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('/comments/{post}', [CommentController::class, 'store'])->name('comments.store');

});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
