<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->whereRaw("to_tsvector('english', title || ' ' || body) @@ websearch_to_tsquery('$search')");
            $query->orderByRaw("ts_rank(searchable, websearch_to_tsquery('$search')) DESC");
        });

        $query->when($filters['category'] ?? false, function ($query, $category) {
            $query->whereHas(
                'category',
                fn($query) =>
                $query->where('slug', $category)
            );
        });

        $query->when($filters['author'] ?? false, function ($query, $author) {
            $query->whereHas(
                'author',
                fn($query) =>
                $query->where('username', $author)
            );
        });
    }

    public function scopeMonthlyStats(Builder $query, int $year, $author_id = null)
    {
        $query->select(
            DB::raw("EXTRACT(MONTH FROM created_at) as month"),
            DB::raw('COUNT(*) as total')
        )
            ->whereBetween('created_at', ["$year-01-01", $year + 1 . "-01-01"])
            ->groupBy('month')
            ->orderBy('month');

        $query->when($author_id ?? false, function ($query, $author_id) {
            $query->where('author_id', $author_id);
        });
    }

    public static function getAvailableYears($author_id = null)
    {
        $query = self::selectRaw("DISTINCT EXTRACT(YEAR FROM created_at) as year")
            ->orderBy('year', 'desc');

        $query->when($author_id ?? false, function ($query, $author_id) {
            $query->where('author_id', $author_id);
        });

        return $query->pluck('year');
    }

    public static function getPostsCount($period = null, $author_id = null)
    {
        $query = self::selectRaw("COUNT(*)");

        $query->when($author_id ?? false, function ($query) use ($author_id) {
            $query->where('author_id', $author_id);
        });

        $query->when($period ?? false, function ($query) use ($period) {
            $query->whereRaw("created_at >= date_trunc('$period', now())
                            AND created_at < date_trunc('$period', now() + INTERVAL '1 $period')");
        });

        return $query->pluck('count')[0];
    }
}
