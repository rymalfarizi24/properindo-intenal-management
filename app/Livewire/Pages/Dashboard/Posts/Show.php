<?php

namespace App\Livewire\Pages\Dashboard\Posts;

use App\Models\Post;
use App\Services\PostService;
use App\Support\SupabaseStorage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.dashboard')]
#[Title('Article Preview — Artikula')]

class Show extends Component
{
    public $post;
    public string | null $imgPath = null;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->imgPath = $post->image ? SupabaseStorage::disk('post-image')->url($post->image) : null;
    }

    public function render()
    {
        return view('livewire.pages.dashboard.posts.show', [
            'title' => 'My Post'
        ]);
    }

    public function destroy($id, PostService $service)
    {
        if (!$service->deletePost($id)) {
            $this->dispatch('toast', type: 'danger', message: 'Failed to delete post!');
            return;
        }

        $this->dispatch('toast', type: 'success', message: 'Post has been deleted succesfully');

        return $this->redirect(
            route('posts-dashboard'),
            navigate: true
        );
    }
}
