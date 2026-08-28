<?php

use App\Http\Middleware\IsAdmin;
use App\Livewire\Pages\About;
use App\Livewire\Pages\Blog;
use App\Livewire\Pages\Blogs;
use App\Livewire\Pages\Contact;
use App\Livewire\Pages\Dashboard\Category as DashboardCategory;
use App\Livewire\Pages\Dashboard\Home as DashboardHome;
use App\Livewire\Pages\Dashboard\Posts\Create as CreatePost;
use App\Livewire\Pages\Dashboard\Posts\Edit as EditPost;
use App\Livewire\Pages\Dashboard\Posts\Index as DashboardPost;
use App\Livewire\Pages\Dashboard\Posts\Show as ShowPost;
use App\Livewire\Pages\Dashboard\Profile;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\SignIn;
use App\Livewire\Pages\SignUp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/about', About::class)->name('about');
Route::get('/blogs', Blogs::class)->name('blogs');
Route::get('/blog/{post:slug}', Blog::class)->name('blog');
Route::get('/contact', Contact::class)->name('contact');

// Authentication
Route::get('/sign-in', SignIn::class)->name('login')->middleware('guest');
Route::get('/sign-up', SignUp::class)->middleware('guest');
Route::post('/sign-out', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
});

Route::get('/profile', Profile::class)->middleware('auth')->name('profile');
Route::get('/dashboard', DashboardHome::class)
->defaults('scope', 'user')
    ->middleware('auth');

Route::get('/dashboard/posts', DashboardPost::class)->middleware('auth')->name('posts-dashboard');
Route::get('/dashboard/posts/create', CreatePost::class)->middleware('auth')->name('post-create');
Route::get('/dashboard/posts/{post:slug}/edit', EditPost::class)->middleware('auth')->name('post-edit');
Route::get('/dashboard/posts/{post:slug}', ShowPost::class)->middleware('auth')->name('post-show');

Route::get('/dashboard/categories', DashboardCategory::class)->middleware(IsAdmin::class)->name('categories-dashboard');
Route::get('/admin/dashboard', DashboardHome::class)
    ->defaults('scope', 'global')
    ->middleware(IsAdmin::class)
    ->name('admin.dashboard');
