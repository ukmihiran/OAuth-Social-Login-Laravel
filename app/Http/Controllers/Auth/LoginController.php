<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    //Google OAuth
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    //Google CallBack
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        $this->createUser($user);

        //return after login
        return redirect()->route('home');
    }

     //Facebook OAuth
     public function redirectToFacebook()
     {
         return Socialite::driver('facebook')->redirect();
     }
     //Facebook CallBack
     public function handleFacebookCallback()
     {
         $user = Socialite::driver('facebook')->user();
 
         $this->createUser($user);

        //return after login
        return redirect()->route('home');
     }

     public function createUser($data)
     {
         $user = User::where('email', '=' , $data->email)->first();
         if (!$user){
             $user = new User();
             $user->name = $data->name;
             $user->email = $data->email;
             $user->provider_id = $data->id;
             $user->avatar = $data->avatar;
             $user->save();

         }
         Auth::login($user);
     }

}
