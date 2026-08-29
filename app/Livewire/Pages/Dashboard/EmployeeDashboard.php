<?php

namespace App\Livewire\Pages\Dashboard;

use App\Models\Employee;
use Livewire\Component;

class EmployeeDashboard extends Component
{
    public function render()
    {
        $employees = Employee::query();

        $totalEmployees = (clone $employees)->count();

        $activeEmployees = (clone $employees)
            ->where('status', true)
            ->count();

        $inactiveEmployees = (clone $employees)
            ->where('status', false)
            ->count();

        $employeesByDepartment = (clone $employees)
            ->selectRaw('department, COUNT(*) as total')
            ->groupBy('department')
            ->orderByDesc('total')
            ->get();

        $recentEmployees = (clone $employees)
            ->latest()
            ->take(5)
            ->get();

        return view('livewire.pages.dashboard.employee-dashboard', compact(
            'totalEmployees',
            'activeEmployees',
            'inactiveEmployees',
            'employeesByDepartment',
            'recentEmployees',
        ));
    }
}
