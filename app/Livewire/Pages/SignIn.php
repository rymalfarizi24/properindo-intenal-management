<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

#[Layout('components.layouts.auth')]
#[Title('Sign In — Artikula')]

class SignIn extends Component
{
    #[Validate('required|email')]
    public string $email;

    #[Validate('required')]
    public string $password;

    public function mount()
    {
        if (session()->has('alert')) {
            $session = session('alert');
            $this->dispatch('alert', type: $session['type'], message: $session['message']);
        }
    }

    public function render()
    {
        return view('livewire.pages.sign-in')->layoutData(['isSignInPage' => true]);
    }

    public function authenticate()
    {
        $credentials = $this->validate();

        if (Auth::attempt($credentials)) {
            session()->regenerate();

            return redirect()->intended('/');
        }

        $this->dispatch('alert', type: 'danger', message: 'Invalid email or password!');
    }
}
