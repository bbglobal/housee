<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{

    public function login()
    {
        return view('admin/login');
    }

    public function signup()
    {
        return view('admin/signup');
    }

    public function reset()
    {
        return view('admin/reset');
    }

    public function register(Request $request)
    {

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'contact' => 'required|unique:users|max:15',
            'password' => 'required|min:8',
            'confirmPassword' => 'required|same:password',
        ]);

        User::create([
            'name' =>  $data['name'],
            'email' => $data['email'],
            'avatar' => url('/') . "/assets/img/avatar.svg",
            'contact' => $data['contact'],
            'password' => $data['password'],
            'role' => 'user',
            'last_activity' => now(),
        ]);

        return redirect()->route('home');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallBack()
    {
        $user = Socialite::driver('google')->user();
        $this->_registerOrLoginUser($user);

        return redirect()->route('home');
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallBack()
    {
        $user = Socialite::driver('facebook')->user();
        $this->_registerOrLoginUser($user);

        return redirect()->route('home');
    }

    public function logout()
    {
        session()->forget("userId");
        Auth::logout();

        return redirect('admin/login');
    }

    protected function _registerOrLoginUser($data)
    {
        $user = User::where('email', '=', $data->email)->first();

        if (!$user) {
            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->provider_id = $data->id;
            $user->avatar = $data->avatar;
            $user->contact = $data->contact;
            $user->password = $data->token;
            $user->role = "user";
            $user->last_activity = now();
            $user->save();
        }

        Auth::login($user);
    }
}
