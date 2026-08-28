<?php

namespace App\Livewire\Pages\Data;

use App\Models\Employee;
use App\Support\SupabaseStorage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditEmployee extends Component
{
    use WithFileUploads;

    public $img;
    public ?string $lastImg = null;
    public string $name;
    public string $department;
    public string $position;
    public string $role;
    public string $status;
    public string $email;
    public string $employee_id;

    public ?string $last_password = null;
    public ?string $new_password = null;
    public ?string $confirm_password = null;

    public function mount(?string $employee_id)
    {
        if ($employee_id) {
            $employee = Employee::find($employee_id);
        } else {
            $employee = auth()->user();
        }

        $this->employee_id = $employee_id;
        $this->name = $employee->name;
        $this->department = $employee->department;
        $this->position = $employee->position;
        $this->role = $employee->role;
        $this->status = $employee->status ? '1' : '0';
        $this->email = $employee->email;
        $this->lastImg = $employee->img ? SupabaseStorage::disk('avatar')->url($employee->img) : null;
    }

    public function render()
    {
        return view('livewire.pages.data.edit-employee');
    }

    public function changeProfile()
    {
        $rules = [
            'name' => ['required', 'max:255'],
            'department' => ['required', 'max:50'],
            'position' => ['required', 'max:50'],
            'role' => ['required', 'max:50'],
            'status' => ['required', 'in:0,1'],
            'email' => ['required', 'email', 'max:100'],
        ];

        $validated_data = $this->validate($rules);

        Employee::where('id', $this->employee_id)->update([
            ...$validated_data,
            'status' => $validated_data['status'] === '1',
        ]);
        $this->dispatch('toast', type: 'success', message: 'Profile updated successfully!');
    }

    public function changePhoto()
    {
        $this->validate([
            'img' => ['required', 'image', 'max:1024']
        ]);

        if ($this->lastImg && SupabaseStorage::disk('avatar')->exists($this->lastImg)) {
            SupabaseStorage::disk('avatar')->delete(
                $this->lastImg
            );
        }
        $path = SupabaseStorage::disk('avatar')->putFile($this->employee_id, $this->img, 'public');

        Employee::where('id', $this->employee_id)->update(['img' => $path]);

        $this->dispatch('toast', type: 'success', message: 'Profile photo updated successfully!');
    }

    public function changePassword()
    {
        $this->validate([
            'last_password' => ['required', 'current_password'],
            'new_password' => ['required', 'min:8'],
            'confirm_password' => ['required', 'same:new_password'],
        ]);

        Employee::where('id', $this->employee_id)->update(['password' => bcrypt($this->new_password)]);

        $this->dispatch('toast', type: 'success', message: 'Password updated successfully!');
    }
}
