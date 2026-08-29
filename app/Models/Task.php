<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Task extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [
        'created_at',
        'updated_at',
        'id',
    ];

    protected $casts = [
        'deadline' => 'datetime',
    ];

    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where('title', 'like', "%$search%");
        });

        $query->when($filters['employee'] ?? false, function ($query, $employee) {
            $query->where('employee_id', $employee);
        });

        $query->when($filters['status'] ?? false, function ($query, $status) {
            $query->where('status', $status);
        });

        $query->when($filters['priority'] ?? false, function ($query, $priority) {
            $query->where('priority', $priority);
        });

        $query->when($filters['deadline'] ?? false, function ($query, $deadline) {
            $deadline = (int) $deadline;

            if ($deadline === -1) {
                // Deadline sudah lewat
                $query->where('deadline', '<', now());
            } else {
                // Deadline dari sekarang sampai N hari ke depan
                $query->whereBetween('deadline', [
                    now(),
                    now()->copy()->addDays($deadline),
                ]);
            }
        });

        // dump($query->toSql());
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
