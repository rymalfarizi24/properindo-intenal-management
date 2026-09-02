<?php

namespace App\Livewire\Components;

use App\Models\Task;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class TasksTable extends Component
{
    use WithPagination;

    #[Url]
    public $search = '';
    #[Url]
    public $employee = '';
    #[Url]
    public $status = '';
    #[Url]
    public $priority = '';
    #[Url]
    public $deadline = '';

    #[Reactive]
    public int $refreshKey;

    public array $employees = [];

    public function mount(?array $employees = null)
    {
        $this->employees = $employees ?? [];
    }

    public function render()
    {
        $filters = [
            'search' => $this->search,
            'employee' => $this->employee,
            'status' => $this->status,
            'priority' => $this->priority,
            'deadline' => $this->deadline,
        ];
        $tasks = Task::filter($filters)->with('employee:id,name');

        if (Gate::denies('supervisor')) {
            $tasks = $tasks->where('employee_id', auth()->user()->id);
        }

        $tasks = $tasks->orderBy('deadline', 'asc')->paginate(5);

        return view(
            'livewire.components.tasks-table',
            compact('tasks')
        );
    }

    public function placeholder()
    {
        return view('components.placeholder.tasks-table');
    }

    #[On('task-saved')]
    public function refreshTable() {}

    public function resetFilters()
    {
        $this->reset([
            'search',
            'employee',
            'status',
            'priority',
            'deadline',
        ]);
        $this->resetPage();
    }

    public function destroy($id)
    {
        Task::destroy($id);
        $this->dispatch('toast', type: 'success', message: 'Task has been deleted succesfully');
    }
}
