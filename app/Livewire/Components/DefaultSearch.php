<?php

namespace App\Livewire\Components;

use App\Livewire\Components\Dashboard\Category\Table;
use Livewire\Attributes\Modelable;
use Livewire\Component;

class DefaultSearch extends Component
{
    #[Modelable]
    public $search = '';

    public function render()
    {
        return view('livewire.components.default-search');
    }

    public function searching()
    {
        $this->dispatch('search-updated');
    }
}
