<?php

namespace App\Livewire\Pages\Data;

use App\Models\ActivityLog;
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

    public array $employee;

    public function mount(?string $employee_id = null)
    {
        if ($employee_id) {
            $this->employee = Employee::find($employee_id)->toArray();
        } else {
            $this->employee = auth()->user()->toArray();
        }

        $this->employee_id = $this->employee['id'];
        $this->name = $this->employee['name'];
        $this->department = $this->employee['department'];
        $this->position = $this->employee['position'];
        $this->role = $this->employee['role'];
        $this->status = $this->employee['status'] ? '1' : '0';
        $this->email = $this->employee['email'];
        $this->lastImg = $this->employee['img'] ? SupabaseStorage::disk('avatar')->url($this->employee['img']) : null;
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
        $validated_data['status'] = $validated_data['status'] === '1';
        $changed_data = $this->getChangedData($this->employee, $validated_data);

        Employee::where('id', $this->employee_id)->update($changed_data['new']);
        ActivityLog::create([
            'changed_by' => auth()->user()->id,
            'employee_id' => $this->employee_id,
            'old_data' => $changed_data['old'],
            'new_data' => $changed_data['new'],
            'action' => 'update',
        ]);
        $this->dispatch('toast', type: 'success', message: 'Profile updated successfully!');
    }

    private function getChangedData($old_data, $new_data)
    {
        $changedOldData = [];
        $changedNewData = [];

        foreach ($new_data as $key => $newValue) {
            $oldValue = $old_data[$key] ?? null;

            if ($oldValue !== $newValue) {
                $changedOldData[$key] = $oldValue;
                $changedNewData[$key] = $newValue;
            }
        }
        return ['old' => $changedOldData, 'new' => $changedNewData];
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
        ActivityLog::create([
            'changed_by' => auth()->user()->id,
            'employee_id' => $this->employee_id,
            'old_data' => ['img' => $this->lastImg],
            'new_data' => ['img' => $path],
            'action' => 'update',
        ]);

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
        ActivityLog::create([
            'changed_by' => auth()->user()->id,
            'employee_id' => $this->employee_id,
            'old_data' => ['password' => '********'],
            'new_data' => ['password' => '********'],
            'action' => 'update',
        ]);

        $this->dispatch('toast', type: 'success', message: 'Password updated successfully!');
    }
}
