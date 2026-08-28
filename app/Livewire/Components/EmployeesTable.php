<?php

namespace App\Livewire\Components;

use App\Models\Employee;
use App\Support\SupabaseStorage;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeesTable extends Component
{
    use WithPagination;

    #[Reactive]
    public $search = '';

    #[Reactive]
    public $category = '';

    public $lastSearch = '';
    public $lastCategory = '';

    public function render()
    {
        return view('livewire.components.employees-table', [
            'employees' => Employee::latest()->paginate(5)
        ]);
    }

    public function placeholder()
    {
        return view('components.placeholder.employees-table');
    }

    public function destroy($id)
    {
        $employee = Employee::find($id, ['img']);

        if (!$employee) {
            return false;
        }

        if ($employee->img) {
            $response = SupabaseStorage::disk('avatar')->delete($employee->img);

            if (!$response) {
                return false;
            }
        }

        Employee::destroy($id);

        $this->dispatch('toast', type: 'success', message: 'Employee has been deleted succesfully');
    }
}
