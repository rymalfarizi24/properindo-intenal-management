<?php

use App\Livewire\Pages\Dashboard\Category as DashboardCategory;
use App\Livewire\Pages\Dashboard\EmployeeDashboard;
use App\Livewire\Pages\Dashboard\Home as DashboardHome;
use App\Livewire\Pages\Dashboard\Posts\Create as CreatePost;
use App\Livewire\Pages\Dashboard\Posts\Edit as EditPost;
use App\Livewire\Pages\Dashboard\Posts\Index as DashboardPost;
use App\Livewire\Pages\Dashboard\Posts\Show as ShowPost;
use App\Livewire\Pages\Dashboard\Profile;
use App\Livewire\Pages\Dashboard\TaskDashboard;
use App\Livewire\Pages\Data\Employee;
use App\Livewire\Pages\Data\Task;
use App\Livewire\Pages\SignIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

Route::get('/', EmployeeDashboard::class)->name('employee-dashboard');
Route::get('/tasks', TaskDashboard::class)->name('tasks-dashboard');

Route::get('/data/employees', Employee::class)->name('employees-data');
Route::get('/data/tasks', Task::class)->name('tasks-data');



// Authentication
Route::get('/sign-in', SignIn::class)->name('login')->middleware('guest');
Route::post('/sign-out', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::get('/profile', Profile::class)->middleware('auth')->name('profile');
Route::get('/dashboard', DashboardHome::class)
    ->defaults('scope', 'user')
    ->middleware('auth');

Route::get('/dashboard/posts', DashboardPost::class)->middleware('auth')->name('posts-dashboard');
Route::get('/dashboard/posts/create', CreatePost::class)->middleware('auth')->name('post-create');
Route::get('/dashboard/posts/{post:slug}/edit', EditPost::class)->middleware('auth')->name('post-edit');
Route::get('/dashboard/posts/{post:slug}', ShowPost::class)->middleware('auth')->name('post-show');

Route::get('/dashboard/categories', DashboardCategory::class)->middleware('role:admin')->name('categories-dashboard');
Route::get('/admin/dashboard', DashboardHome::class)
    ->defaults('scope', 'global')
    ->middleware('role:admin')
    ->name('admin.dashboard');
