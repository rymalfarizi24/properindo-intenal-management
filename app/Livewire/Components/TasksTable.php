<?php

namespace App\Livewire\Components;

use App\Models\Employee;
use App\Models\Task;
use Livewire\Attributes\On;
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

    public array $employees = [];


    public function mount()
    {
        $this->employees = Employee::select('id', 'name')->get()->toArray();
    }

    #[On('toast')]
    public function render()
    {
        $filters = [
            'search' => $this->search,
            'employee' => $this->employee,
            'status' => $this->status,
            'priority' => $this->priority,
            'deadline' => $this->deadline,
        ];
        $tasks = Task::filter($filters)->with('employee:id,name')->orderBy('deadline', 'asc')->paginate(5);

        return view(
            'livewire.components.tasks-table',
            compact('tasks')
        );
    }

    public function placeholder()
    {
        return view('components.placeholder.tasks-table');
    }

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
