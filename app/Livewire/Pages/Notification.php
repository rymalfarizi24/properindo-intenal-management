<?php

namespace App\Livewire\Pages;

use App\Models\Notification as ModelsNotification;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class Notification extends Component
{
    use WithPagination;

    public function render()
    {
        $notifications = ModelsNotification::query()
            ->with('task.employee')
            ->latest();

        if (Gate::denies('supervisor')) {
            $notifications->whereHas('task', function ($query) {
                $query->where('employee_id', auth()->id());
            });
        }

        return view('livewire.pages.notification', [
            'notifications' => $notifications->paginate(10),
        ]);
    }
}
