<?php

namespace App\Livewire\Components;

use App\Models\Employee;
use App\Models\Task;
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

    public function render()
    {
        $this->resetPage();
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
            [
                'tasks' => $tasks,
            ]
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


    // public function destroy($id)
    // {
    //     $employee = Employee::find($id);
    //     $changed_by = auth()->user()->id;

    //     if ($changed_by === $id) {
    //         return $this->dispatch('toast', type: 'error', message: 'You cannot delete your own account');
    //     }

    //     if (!$employee) {
    //         return $this->dispatch('toast', type: 'error', message: 'Employee not found');
    //     }

    //     if ($employee->img) {
    //         $response = SupabaseStorage::disk('avatar')->delete($employee->img);

    //         if (!$response) {
    //             return $this->dispatch('toast', type: 'error', message: 'Employee not found');
    //         }
    //     }

    //     Employee::destroy($id);

    //     $this->dispatch('toast', type: 'success', message: 'Employee has been deleted succesfully');
    // }
}
