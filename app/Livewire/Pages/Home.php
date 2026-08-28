<?php

namespace App\Livewire\Pages;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Artikula — A Digital Reading Space for Thoughtful Articles')]

class Home extends Component
{
    public $search = '';

    public function render()
    {
        $popularCategories = Category::postsCategoriesCount()->orderBy('posts_count', 'desc')->limit(4);
        $posts = Post::with(['category', 'author'])->latest()->limit(3);

        return view('livewire.pages.home', [
            'popular_categories' => Cache::remember('posts.popular.categories', 180, fn() => $popularCategories->get()),
            'latest_posts' => Cache::remember('posts.home', 180, fn() => $posts->get()),
            'total_posts' => Cache::remember('posts.total', 180, fn() => Post::count()),
            'total_posts_year' => Cache::remember('posts.total.year', 180, fn() => Post::getPostsCount('year')),
            'total_categories' => Cache::remember('categories.total', 180, fn() => Category::count()),
            'total_authors' => Cache::remember('authors.total', 180, fn() => User::count()),
        ]);
    }

    public function signIn()
    {
        if (Auth::check()) {
            return $this->redirect('/dashboard/posts');
        }

        session()->flash('alert', [
            'type' => 'warning',
            'message' => 'Please, login first!'
        ]);
        return $this->redirect('/sign-in');
    }

    public function searching()
    {
        return $this->redirect(
            '/blogs?search=' . $this->search,
            navigate: true,
        );
    }
}
