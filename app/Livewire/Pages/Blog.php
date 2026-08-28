<?php

namespace App\Livewire\Pages;

use App\Models\Post;
use App\Support\SupabaseStorage;
use Livewire\Component;

class Blog extends Component
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
        return view('livewire.pages.blog', [
            'pageTitle' => 'Single Post'
        ])->title($this->post->title . ' - Artikula');
    }
}
