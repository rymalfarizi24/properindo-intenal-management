<?php

use App\Livewire\Pages\ActivityLogs;
use App\Livewire\Pages\Dashboard\EmployeeDashboard;
use App\Livewire\Pages\Dashboard\TaskDashboard;
use App\Livewire\Pages\Data\CreateEmployee;
use App\Livewire\Pages\Data\EditEmployee;
use App\Livewire\Pages\Data\Employee;
use App\Livewire\Pages\Data\Task;
use App\Livewire\Pages\Notification;
use App\Livewire\Pages\Profile;
use App\Livewire\Pages\SignIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', TaskDashboard::class)->name('tasks-dashboard');
    Route::get('/employees', EmployeeDashboard::class)->name('employee-dashboard');
    Route::get('/notification', Notification::class)->name('notification');
    Route::get('/tasks', TaskDashboard::class)->name('tasks-dashboard');
    Route::get('/data/tasks', Task::class)->name('tasks-data');
    Route::get('/profile', Profile::class)->middleware('auth')->name('profile');
});


Route::middleware('role:admin,supervisor')->group(function () {
    Route::get('/data/employees', Employee::class)->name('employees-data');
});

Route::middleware('role:admin')->group(function () {
    Route::get('/activity-log', ActivityLogs::class)->name('activity-log');
    Route::get('/data/employees/create', CreateEmployee::class)->name('employee-create');
    Route::get('/data/employees/{employee_id}/edit', EditEmployee::class)->name('employee-edit');
});

// Authentication
Route::get('/sign-in', SignIn::class)->name('login')->middleware('guest');
Route::post('/sign-out', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');