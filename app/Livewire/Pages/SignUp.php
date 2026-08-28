<?php

namespace App\Livewire\Pages;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components/layouts/auth')]
#[Title('Create an Account — Artikula')]

class SignUp extends Component
{
    #[Validate("required|email:dns|unique:users,email")]
    public string $email = '';

    #[Validate("required|max:255")]
    public string $name = '';

    #[Validate(["required", "unique:users,username"])]
    public string $username = '';


    #[Validate(["required", "unique:users,username", 'min:5', 'confirmed'])]
    public string $password = '';

    public string $password_confirmation = '';

    public function render()
    {
        return view('livewire.pages.sign-up')->layoutData(['isSignInPage' => false]);
    }

    function store()
    {
        $validatedData = $this->validate();
        User::create($validatedData);

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Registration Successful. Please login!'
        ]);

        $this->redirect(
            route('login'),
            navigate: true
        );
    }
}
