<?php

namespace App\Livewire\Components;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;

class BlogsSection extends Component
{
    use WithPagination;

    #[Reactive]
    public $search = '';
    #[Reactive]
    public $category = '';
    #[Reactive]
    public $author = '';

    public $lastSearch, $lastCategory, $lastAuthor;

    public function render()
    {
        // Reset page while searching
        if ($this->lastSearch != $this->search || $this->lastCategory != $this->category || $this->lastAuthor != $this->author) {
            $this->resetPage();
        }
        $this->lastSearch = $this->search;
        $this->lastCategory = $this->category;
        $this->lastAuthor = $this->author;

        $filter = [
            'search' => $this->search,
            'category' => $this->category,
            'author' => $this->author,
        ];

        $query = Post::with(['category', 'author'])->filter($filter)->latest();

        if (!$this->search && !$this->category && !$this->author && $this->getPage() < 5) {
            $posts = Cache::remember('posts.page.' . $this->getPage(), 180, fn() => $query->paginate(6));
        } else {
            $posts = $query->paginate(6);
        }

        return view('livewire.components.blogs-section', [
            'posts' => $posts
        ]);
    }

    public function placeholder()
    {
        return view('components.blogs.section.skeleton');
    }

    public function setCategory($slug)
    {
        $this->dispatch('set-category', slug: $slug);
        $this->resetPage();
    }

    public function setAuthor($username)
    {
        $this->dispatch('set-author', username: $username);
        $this->resetPage();
    }
}
