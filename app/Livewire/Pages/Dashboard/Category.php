<?php

namespace App\Livewire\Pages\Dashboard;

use App\Models\Category as CategoryModel;
use App\Services\CategoryService;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.dashboard')]
#[Title('Manage Category — Admin Artikula')]

class Category extends Component
{
    protected $listeners = ['search-updated'];

    public $search = '';
    public $name = '';
    public $slug = '';
    public $lastSlug;
    public $id = null;
    public $color = '#4A90E2';
    public $lastColor = '#4A90E2';

    public function render()
    {
        return view('livewire.pages.dashboard.category');
    }

    #[On('reset-error')]
    public function resetErrorInput()
    {
        $this->resetErrorBag();
    }

    public function save()
    {
        $rules = [
            'name' => ['required', 'min:3'],
            'slug' => ['required', Rule::unique('categories', 'slug')],
            'color' => ['required', Rule::unique('categories', 'color')]
        ];

        if (!$this->id) {
            // Create New Category
            $validatedData = $this->validate($rules);
            CategoryModel::create($validatedData);
            $this->dispatch('toast', type: 'success', message: 'New category has been added!');
        } else {
            // Update Category
            $rules['slug'][1] = $rules['slug'][1]->ignore($this->lastSlug, 'slug');
            $rules['color'][1] = $rules['color'][1]->ignore($this->lastColor, 'color');
            $validatedData = $this->validate($rules);
            CategoryModel::where('id', $this->id)->update($validatedData);
            $this->dispatch('toast', type: 'success', message: 'Category has been updated');
        }

        // Reset Input
        CategoryService::clearCache();
    }

    #[On('reset-search')]
    public function resetSearch()
    {
        $this->reset('search');
    }
}
