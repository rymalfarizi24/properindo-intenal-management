<?php

namespace App\Livewire\Pages\Data;

use App\Models\Employee;
use App\Models\Task as ModelsTask;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\On;
use Livewire\Component;

class Task extends Component
{
    public ?string $id = null;
    public string $title = '';
    public string $status = '';
    public string $priority = '';
    public $deadline = '';
    public string $employee_id = '';

    public array $employees = [];

    public function mount()
    {
        if (Gate::allows('supervisor')) {
            $this->employees = Employee::select('id', 'name')->pluck('name', 'id')->toArray();
        }
    }

    public function render()
    {
        return view('livewire.pages.data.task');
    }

    public function save()
    {
        $rules = [
            'title' => ['required', 'min:3'],
            'status' => ['required', 'in:pending,progress,completed'],
            'priority' => ['required', 'in:low,medium,high'],
            'deadline' => ['required', 'date'],
            'employee_id' => ['required', 'exists:employees,id'],
        ];

        $validatedData = $this->validate($rules);
        if ($this->id) {
            ModelsTask::where('id', $this->id)->update($validatedData);
            $message = 'Task has been updated';
        } else {
            ModelsTask::create($validatedData);
            $message = 'New task has been added!';
        }

        $this->dispatch('toast', type: 'success', message: $message);
    }
}
