<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SocialiteController extends Controller
{
    public function redirect($user) {
            return Socialite::driver('github')->redirect();
        }
    
    public function callback ($user) {
        //info of user in github
        // $user = Socialite::driver('github')->stateless()->user();
        
        $githubUser = Socialite::driver('github')->stateless()->user();
    // dd($githubUser);
    $user = User::updateOrCreate([
        'provider_id' => $githubUser->id,
    ], [
        'name' => $githubUser->nickname,
        'email' => $githubUser->email,
        'password' => Hash::make(Str::random(8)),//create password random
        'provider_token' => $githubUser->token,
        'provider_refresh_token' => $githubUser->refreshToken,
    ]);
 
    Auth::login($user);
    
    return redirect('home');
        // dd($user);
     
        // $user->token
    }
}
