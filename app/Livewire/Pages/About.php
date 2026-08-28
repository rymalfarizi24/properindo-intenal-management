<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('About Artikula — A Digital Space for Reading & Ideas')]

class About extends Component
{
    public function render()
    {
        return view('livewire.pages.about');
    }
}
