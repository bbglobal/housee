<?php

namespace App\Livewire;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $contact;
    public $password;
    public $remember;

    public function render()
    {
        return view('livewire.login');
    }

    public function login()
    {
        $this->validate([
            'contact' => 'required',
            'password' => 'required',
        ]);

        $credentials = [
            'contact' => $this->contact,
            'password' => $this->password,
        ];

        if (Auth::attempt($credentials, $this->remember)) {
            $user = Auth::user();

            session()->put("userId", $user->id);

            if ($user->role === "user") {
                return redirect('/');
            } else {
                return redirect('admin');
            }
        }

        // session()->flash('warning', 'Login details are not valid');
        return redirect()->back()->with('warning', 'Login details are not valid');
    }
}
