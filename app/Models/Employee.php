<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use Notifiable;

    protected $table = 'employees';

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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public static function getDepartments()
    {
        return self::select('department')
            ->distinct()
            ->pluck('department')
            ->toArray();
    }

    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
        });

        $query->when($filters['department'] ?? false, function ($query, $department) {
            $query->where('department', $department);
        });

        $query->when($filters['role'] ?? false, function ($query, $role) {
            $query->where('role', $role);
        });

        $query->when($filters['status'] !== '', function ($query) use ($filters) {
            $query->where('status', $filters['status']);
        });
    }
}
