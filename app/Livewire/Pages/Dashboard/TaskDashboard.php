<?php

namespace App\Livewire\Pages\Dashboard;

use App\Models\Task;
use Livewire\Component;

class TaskDashboard extends Component
{
    public function render()
    {
        $tasks = Task::query();

        $user = auth()->user();
        if ($user->role === 'employee') {
            $tasks->where('employee_id', $user->id);
        }

        $totalTasks = (clone $tasks)->count();

        $notStartedTasks = (clone $tasks)
            ->where('status', 'pending')
            ->count();

        $inProgressTasks = (clone $tasks)
            ->where('status', 'progress')
            ->count();

        $completedTasks = (clone $tasks)
            ->where('status', 'completed')
            ->count();

        $approachingDeadlineTasks = (clone $tasks)
            ->where('status', '!=', 'completed')
            ->whereBetween('deadline', [
                now()->startOfDay(),
                now()->addDays(3)->endOfDay(),
            ])
            ->count();

        $overdueTasks = (clone $tasks)
            ->where('status', '!=', 'completed')
            ->whereDate('deadline', '<', now())
            ->count();

        $approachingTasks = (clone $tasks)
            ->with('employee')
            ->where('status', '!=', 'completed')
            ->whereBetween('deadline', [
                now(),
                now()->addDays(3),
            ])
            ->orderBy('deadline')
            ->limit(3)
            ->get();

        return view('livewire.pages.dashboard.task-dashboard', compact(
            'totalTasks',
            'notStartedTasks',
            'inProgressTasks',
            'completedTasks',
            'approachingDeadlineTasks',
            'overdueTasks',
            'approachingTasks',
        ));
    }
}
