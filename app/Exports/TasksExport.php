<?php

namespace App\Exports;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\FromCollection;

class TasksExport implements FromCollection
{
    public function __construct(
        protected array $filters
    ) {}

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Task::filter($this->filters)->latest()->get();
    }
}
