<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'color'];
    public $timestamps = false;

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'category_id');
    }

    public function scopePostsCategoriesCount(Builder $query, $author_id = null)
    {
        $query->select(['name', 'color'])
            ->whereHas('posts', function ($q) use ($author_id) {
                if ($author_id) {
                    $q->where('author_id', $author_id);
                }
            })
            ->withCount([
                'posts' => function ($q) use ($author_id) {
                    if ($author_id) {
                        $q->where('author_id', $author_id);
                    }
                }
            ]);
    }

    public function scopeSearching(Builder $query, $search = '')
    {
        $query->when($search ?? false, function ($query, $search) {
            $query->whereRaw("LOWER(name) LIKE '%" . Str::lower($search) . "%'");
        });
    }
}
