<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmployeeExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(
        protected array $filters
    ) {}

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Employee::filter($this->filters)
            ->latest()
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Department',
            'Position',
            'Role',
            'Status',
            'Email',
            'Created At',
        ];
    }

    public function map($employee): array
    {
        return [
            $employee->id,
            $employee->name,
            $employee->department,
            $employee->position,
            $employee->role,
            $employee->status ? 'Active' : 'Inactive',
            $employee->email,
            $employee->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
