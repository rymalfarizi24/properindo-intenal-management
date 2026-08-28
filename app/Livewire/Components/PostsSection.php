<?php

namespace App\Livewire\Components;

use App\Models\Post;
use App\Services\PostService;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;

class PostsSection extends Component
{
    use WithPagination;

    #[Reactive]
    public $search = '';

    #[Reactive]
    public $category = '';

    public $lastSearch = '';
    public $lastCategory = '';

    public function render()
    {
        if ($this->lastSearch != $this->search || $this->lastCategory != $this->category) {
            $this->resetPage();
        }

        $this->lastSearch = $this->search;
        $this->lastCategory = $this->category;

        $filter = [
            'search' => $this->search,
            'category' => $this->category,
        ];

        return view('livewire.components.posts-section', [
            'posts' => Post::with(['category'])->where('author_id', auth()->user()->id)->filter($filter)->latest()->paginate(5)
        ]);
    }

    public function placeholder()
    {
        return view('components.placeholder.posts-table');
    }

    public function destroy($id)
    {
        $service = new PostService;
        $response = $service->deletePost($id);

        if (!$response) {
            $this->dispatch('toast', type: 'danger', message: 'Failed to delete post!');
            return;
        }

        $this->dispatch('toast', type: 'success', message: 'Post has been deleted succesfully');
    }

    public function resetSearch()
    {
        $this->dispatch('reset-search');
        $this->resetPage();
    }
}
