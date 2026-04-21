<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BlogPost extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'featured_image_path',
        'published_at',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'sort_order' => 'integer',
        ];
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Builder<BlogPost>  $query
     * @return \Illuminate\Database\Eloquent\Builder<BlogPost>
     */
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')->where('published_at', '<=', now());
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Builder<BlogPost>  $query
     * @return \Illuminate\Database\Eloquent\Builder<BlogPost>
     */
    public function scopeOrdered($query)
    {
        return $query->orderByDesc('published_at')->orderByDesc('sort_order')->orderByDesc('id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(BlogCategory::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(BlogTag::class);
    }

    public function isPublished(): bool
    {
        return $this->published_at !== null && $this->published_at->lte(now());
    }

    public function featuredImageUrl(): ?string
    {
        if ($this->featured_image_path === null || $this->featured_image_path === '') {
            return null;
        }

        return asset($this->featured_image_path);
    }
}
