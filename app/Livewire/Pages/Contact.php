<?php

namespace App\Livewire\Pages;

use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Contact Artikula — Get in Touch')]

class Contact extends Component
{
    #[Validate('required')]
    public string $name = '';

    #[Validate('required|email')]
    public string $email = '';

    #[Validate('required | max:63')]
    public string $subject = '';

    #[Validate('required | max:255')]
    public string $message = '';

    public function mount()
    {
        if (Auth::check()) {
            $this->name = auth()->user()->name;
            $this->email = auth()->user()->email;
        }
    }

    public function render()
    {
        return view('livewire.pages.contact');
    }

    public function sendMessage()
    {
        $validatedData = $this->validate();
        Message::create($validatedData);

        $this->dispatch('toast', type: 'success', message: 'Message has been sended!');
        $this->reset('subject', 'message');
    }
}
