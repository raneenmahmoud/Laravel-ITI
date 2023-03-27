<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Auth\SocialiteController;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

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


Route::get("/auth/{provider}/redirect",[SocialiteController::class,'redirect'])->name("socilaites.redirect");
Route::get("/auth/{provider}/callback",[SocialiteController::class,'callback'])->name("socilaites.callback");



Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
});
 
Route::get('/auth/callback', function () {
    //info of user in github
    // $user = Socialite::driver('github')->stateless()->user();
    
    $githubUser = Socialite::driver('github')->stateless()->user();
    // dd($githubUser);
    $user = User::updateOrCreate([
        'provider_id' => $githubUser->id,
    ], [
        'name' => $githubUser->nickname,
        'email' => $githubUser->email,
        'password' => Hash::make(Str::random(8)),
        'provider_token' => $githubUser->token,
        'provider_refresh_token' => $githubUser->refreshToken,
    ]);
 
    Auth::login($user);
    return redirect('/posts');;
    // dd($user);
 
    // $user->token
});
