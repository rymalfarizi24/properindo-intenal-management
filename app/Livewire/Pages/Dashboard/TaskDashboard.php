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

        $statusCounts = (clone $tasks)
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

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
            'statusCounts',
            'approachingDeadlineTasks',
            'overdueTasks',
            'approachingTasks',
        ));
    }
}
