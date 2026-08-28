<?php

namespace App\Livewire\Components;

use App\Models\Employee;
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
            'employees' => Employee::paginate(5)
        ]);
    }

    public function placeholder()
    {
        return view('components.placeholder.employees-table');
    }
}
