<?php

namespace App\Livewire\Pages\Data;

use App\Models\Employee;
use App\Models\Task as ModelsTask;
use Illuminate\Support\Facades\Gate;
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

    public function mount(?array $employees = null)
    {
        $this->employees = $employees ?? [];
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
            $validatedData['id'] = $this->id;
            $message = 'Task has been updated';
        } else {
            $message = 'New task has been added!';
        }
        // Reset Input
        ModelsTask::updateOrCreate($validatedData);
        $this->dispatch('toast', type: 'success', message: $message);
    }
}
