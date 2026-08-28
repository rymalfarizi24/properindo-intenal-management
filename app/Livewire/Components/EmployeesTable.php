<?php

namespace App\Livewire\Components;

use App\Models\ActivityLog;
use App\Models\Employee;
use App\Support\SupabaseStorage;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeesTable extends Component
{
    use WithPagination;

    #[Url]
    public string $search = '';
    #[Url]
    public string $department = '';
    #[Url]
    public string $role = '';
    #[Url]
    public string $status = '';

    public array $departments = [];


    public function mount()
    {
        $this->departments = Employee::getDepartments();
    }

    public function render()
    {
        $employees = Employee::filter([
            'search' => $this->search,
            'department' => $this->department,
            'role' => $this->role,
            'status' => $this->status,
        ])
            ->latest()
            ->paginate(5);

        $this->resetPage();

        return view('livewire.components.employees-table', compact('employees'));
    }

    public function placeholder()
    {
        return view('components.placeholder.employees-table');
    }

    public function resetFilters()
    {
        $this->reset(['search', 'department', 'role', 'status']);
        $this->resetPage();
    }


    public function destroy($id)
    {
        $employee = Employee::find($id);
        $changed_by = auth()->user()->id;

        if ($changed_by === $id) {
            return $this->dispatch('toast', type: 'error', message: 'You cannot delete your own account');
        }

        if (!$employee) {
            return $this->dispatch('toast', type: 'error', message: 'Employee not found');
        }

        if ($employee->img) {
            $response = SupabaseStorage::disk('avatar')->delete($employee->img);

            if (!$response) {
                return $this->dispatch('toast', type: 'error', message: 'Employee not found');
            }
        }

        ActivityLog::create([
            'changed_by' => $changed_by,
            'old_data' => json_encode($employee->toArray()),
            'action' => 'delete',
        ]);

        Employee::destroy($id);


        $this->dispatch('toast', type: 'success', message: 'Employee has been deleted succesfully');
    }
}
