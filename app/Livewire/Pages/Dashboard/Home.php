<?php

namespace App\Livewire\Pages\Dashboard;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Layout;
use Livewire\Component;


#[Layout('components.layouts.dashboard')]

class Home extends Component
{
    public $selectedYear1 = null;
    public $selectedYear2 = null;
    public $availableYears = null;

    public $scope = 'user';
    protected $author_id = null;

    public function mount($scope = 'user')
    {
        $this->scope = $scope;
        $this->author_id = $scope === 'user' ? auth()->user()->id : null;

        $availableYears = Post::getAvailableYears();

        $this->availableYears = $availableYears;
        $this->selectedYear1 = $availableYears[1];
        $this->selectedYear2 = $availableYears[0];
    }

    public function render()
    {
        $total_posts_all = 0;
        $total_posts_year = 0;

        if ($this->scope == 'global') {
            $total_posts_all = Cache::remember('posts.total', 180, fn() => Post::count());
            $total_posts_year = Cache::remember('posts.total.year', 180, fn() => Post::getPostsCount('year'));
        } else {
            $total_posts_all = Post::getPostsCount(null, $this->author_id);
            $total_posts_year = Post::getPostsCount('year', $this->author_id);
        }

        return view('livewire.pages.dashboard.home', [
            'total_posts_all' => $total_posts_all,
            'total_posts_year' => $total_posts_year,
            'total_posts_month' => Post::getPostsCount('month', $this->author_id),
            'total_posts_today' => Post::getPostsCount('day', $this->author_id)
        ])->title("Dashboard — " . ($this->scope == 'global' ? 'Admin ' : '') . "Artikula");
    }
}
