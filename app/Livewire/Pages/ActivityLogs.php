<?php

namespace App\Livewire\Pages;

use App\Models\ActivityLog;
use App\Models\Employee;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ActivityLogs extends Component
{
    use WithPagination;

    #[Url]
    public string $search = '';
    #[Url]
    public string $action = '';
    #[Url]
    public string $date = '';

    public ?ActivityLog $selectedLog = null;

    public function render()
    {
        $logs = ActivityLog::query()
            ->with([
                'employee:id,name,email',
                'changedBy:id,name,role',
            ])
            ->when($this->search, function ($query) {
                $search = strtolower($this->search);

                $query->whereHas('employee', function ($query) use ($search) {
                    $query->whereRaw(
                        'LOWER(name) LIKE ?',
                        ["%{$search}%"]
                    );
                })
                    ->orWhereHas('changedBy', function ($query) use ($search) {
                        $query->whereRaw(
                            'LOWER(name) LIKE ?',
                            ["%{$search}%"]
                        );
                    });
            })
            ->when($this->action, function ($query) {
                $query->where('action', $this->action);
            })
            ->when($this->date, function ($query) {
                $query->whereDate('created_at', $this->date);
            })
            ->latest('created_at')
            ->paginate(10);

        // dd($logs->toArray());

        return view('livewire.pages.activity-logs', compact('logs'));
    }


    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function updatingAction()
    {
        $this->resetPage();
    }


    public function updatingDate()
    {
        $this->resetPage();
    }


    public function showDetail($id)
    {
        $this->selectedLog = ActivityLog::with([
            'employee',
            'changedBy',
        ])->findOrFail($id);
    }


    public function closeDetail()
    {
        $this->selectedLog = null;
    }

    public function getEmployeeName(ActivityLog $selectedLog)
    {
        switch ($selectedLog->action) {
            case 'update':
                return $selectedLog->employee;
            case 'create':
                return $selectedLog->new_data;
            default:
                return $selectedLog->old_data;
        }
    }
}
