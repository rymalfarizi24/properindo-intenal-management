<?php

namespace App\Livewire\Pages\Dashboard\Posts;

use App\Models\Post;
use App\Services\CategoryService;
use App\Services\PostService;
use App\Support\SupabaseStorage;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.dashboard')]
#[Title('Article Edit — Dashboard Artikula')]

class Edit extends Component
{
    use WithFileUploads;

    public string $title = '';
    public string $slug = '';
    public ?int $category_id = null;
    public $image = null;
    public ?string $lastImage = null;
    public ?string $imgPath = null;
    public string $body = '';
    public $post_id = null;

    public function mount(Post $post)
    {
        $this->title = $post['title'];
        $this->slug = $post['slug'];
        $this->category_id = $post['category_id'];
        $this->lastImage = $post['image'] ?? null;
        $this->imgPath = $this->lastImage ? SupabaseStorage::disk('profile-image')->url($this->lastImage) : null;
        $this->body = $post['body'];
        $this->post_id = $post['id'];
    }

    public function render()
    {
        $categories = CategoryService::cacheAll();

        return view('livewire.pages.dashboard.posts.save', [
            'categories' => $categories,
            'isEdit' => true,
        ]);
    }

    public function save(PostService $service)
    {
        $rules = [
            'title' => ['required', 'max:255'],
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($this->post_id)],
            'category_id' => ['required'],
            'body' => ['required'],
            'image' => 'nullable|image|max:2048'
        ];
        $validatedData = $this->validate($rules);

        $response = $service->editPost($this->post_id, $validatedData, $this->image, $this->lastImage);

        if (!$response) {
            $this->dispatch('toast', type: 'danger', message: 'Failed to edit post!');
        }

        $this->dispatch('toast', type: 'success', message: 'Post has been updated!');
        return $this->redirect(
            route('post-show', ['post' => $this->slug]),
            navigate: true
        );
    }
}
