<?php

namespace App\Livewire\Pages\Dashboard\Posts;

use App\Models\Category;
use App\Services\PostService;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

#[Layout('components.layouts.dashboard')]
#[Title('Create New Article — Dashboard Artikula')]

class Create extends Component
{
    use WithFileUploads;

    #[Validate(['required', 'max:255'])]
    public $title = '';

    #[Validate(['required', 'unique:posts,slug'])]
    public $slug = '';

    #[Validate(['required'])]
    public $category_id = null;

    #[Validate(['required'])]
    public $body = '';

    #[Validate('image|file|max:2048')]
    public TemporaryUploadedFile | null $image = null;

    public function render()
    {
        return view('livewire.pages.dashboard.posts.save', [
            'categories' => Category::all(['id', 'name']),
            'isEdit' => false,
        ]);
    }

    public function save(PostService $service)
    {

        $validatedData = $this->validate();
        $response = $service->createPost($validatedData, $this->image);

        if (!$response) {
            $this->dispatch('toast', type: 'danger', message: 'Failed to create new post');
            return;
        }

        $this->dispatch('toast', type: 'success', message: 'New post has been added');
        return $this->redirect(
            route('post-show', ['post' => $this->slug]),
            navigate: true
        );
    }
}
