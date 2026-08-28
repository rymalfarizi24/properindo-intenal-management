<?php

namespace App\Livewire\Pages\Data;

use App\Models\ActivityLog;
use App\Models\Employee;
use Livewire\Component;

class CreateEmployee extends Component
{
    public string $name;
    public string $department;
    public string $position;
    public string $role = 'employee';
    public string $status = '1';
    public string $email;
    public string $employee_id;

    public ?string $password = null;
    public ?string $confirm_password = null;

    public function render()
    {
        return view('livewire.pages.data.create-employee');
    }

    public function createEmployee()
    {
        $rules = [
            'name' => ['required', 'max:255'],
            'department' => ['required', 'max:50'],
            'position' => ['required', 'max:50'],
            'role' => ['required', 'max:50'],
            'status' => ['required', 'in:0,1'],
            'email' => ['required', 'email', 'max:100'],
            'password' => ['required', 'min:8'],
            'confirm_password' => ['required', 'same:password'],
        ];

        $validated_data = $this->validate($rules);
        $validated_data['status'] = $validated_data['status'] === '1';

        try {
            Employee::create($validated_data);

            ActivityLog::create([
                'employee_id' => auth()->user()->id,
                'old_data' => null,
                'new_data' => json_encode($validated_data),
            ]);
        } catch (\Exception $e) {
            $this->dispatch('toast', type: 'error', message: $e->getMessage());
            return;
        }

        $this->dispatch('toast', type: 'success', message: 'Employee created successfully!');
    }
}
