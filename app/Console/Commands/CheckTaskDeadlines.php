<?php

namespace App\Console\Commands;

use App\Models\Notification;
use App\Models\Task;
use Illuminate\Console\Command;

class CheckTaskDeadlines extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:check-deadlines';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notifications for upcoming and overdue tasks';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->checkUpcomingTasks(24, 'Upcoming Deadline', 'reminder', 'Task is approaching its deadline.');
        $this->checkUpcomingTasks(3, 'Imminent Deadline', 'alert', 'Task is due soon.');
        $this->checkOverdueTasks();

        $this->info('Task deadline notifications checked.');

        return self::SUCCESS;
    }

    private function checkUpcomingTasks(int $hours, string $title, string $type, string $message)
    {
        $tasks = Task::where('status', '!=', 'completed')
            ->whereBetween('deadline', [
                now(),
                now()->addHours($hours),
            ])
            ->get();

        foreach ($tasks as $task) {
            Notification::firstOrCreate(
                [
                    'task_id' => $task->id,
                    'type' => $type,
                ],
                [
                    'title' => $title,
                    'message' => $message,
                ]
            );
        }
    }

    private function checkOverdueTasks()
    {
        $tasks = Task::where('status', '!=', 'completed')
            ->where('deadline', '<', now())
            ->get();

        foreach ($tasks as $task) {
            Notification::firstOrCreate(
                [
                    'task_id' => $task->id,
                    'type' => 'late',
                ],
                [
                    'title' => 'Overdue Task',
                    'message' => "Task \"{$task->title}\" has passed its deadline.",
                ]
            );
        }
    }
}
