<?php

namespace App\Livewire\Pages\Dashboard\Posts;

use App\Services\PostService;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout('components.layouts.dashboard')]
#[Title('Manage Article — Artikula')]

class Index extends Component
{
    #[Url]
    public $search = '';

    #[Url]
    public $category = '';

    public function render()
    {
        return view('livewire.pages.dashboard.posts.index');
    }

    #[On('set-category')]
    public function setCategory($slug)
    {
        $this->category = $slug;
    }

    #[On('reset-search')]
    public function resetSearch()
    {
        $this->reset('search');
    }

    #[On('delete-confirm')]
    public function destroy($id, PostService $service)
    {
        if (!$service->deletePost($id)) {
            $this->dispatch('toast', type: 'danger', message: 'Failed to delete post!');
            return;
        }

        $this->dispatch('toast', type: 'success', message: 'Post has been deleted succesfully');
    }
}
