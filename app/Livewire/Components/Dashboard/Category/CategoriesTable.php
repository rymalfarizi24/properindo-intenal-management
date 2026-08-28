<?php

namespace App\Livewire\Components\Dashboard\Category;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Database\QueryException;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class CategoriesTable extends Component
{
    use WithPagination, WithoutUrlPagination;

    #[Reactive]
    public $search = '';

    public $lastSearch;

    public function render()
    {
        if ($this->lastSearch != $this->search) {
            $this->resetPage();
        }

        if ($this->search) {
            $categories = Category::searching($this->search)->simplePaginate(5);
        } else {
            $categories = CategoryService::pageCache($this->getPage(), 5);
        }

        return view('livewire.components.dashboard.category.categories-table', [
            'categories' => $categories
        ]);
    }

    public function destroy($id)
    {
        try {
            Category::destroy($id);
            CategoryService::clearCache();
            $this->dispatch('toast', type: 'success', message: 'Category has been deleted succesfully');
        } catch (QueryException $e) {
            if ($e->getCode() == '23503') {
                $this->dispatch('toast', type: 'success', message: 'Categories are still referenced by other data');
                return;
            }
            $this->dispatch('toast', type: 'success', message: 'Error deleted category');
        }
    }

    public function resetSearch()
    {
        $this->dispatch('reset-search');
        $this->resetPage();
    }

    public function placeholder()
    {
        return view('components.placeholder.categories-table');
    }
}
