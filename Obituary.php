<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Obituary extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date_of_birth',
        'date_of_death',
        'content',
        'author',
        'submission_date',
        'slug',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'date_of_death' => 'date',
        'submission_date' => 'datetime',
    ];

    /**
     * Automatically generate a unique slug when creating an obituary.
     */
    protected static function booted(): void
    {
        static::creating(function (Obituary $obituary) {
            if (empty($obituary->slug)) {
                $base = Str::slug($obituary->name);
                $slug = $base;
                $counter = 1;

                while (static::where('slug', $slug)->exists()) {
                    $slug = "{$base}-{$counter}";
                    $counter++;
                }

                $obituary->slug = $slug;
            }

            if (empty($obituary->submission_date)) {
                $obituary->submission_date = now();
            }
        });
    }

    /**
     * Route model binding uses the slug instead of the id (nicer, SEO-friendly URLs).
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * A short, meta-description-friendly excerpt of the obituary content.
     */
    public function excerpt(int $length = 160): string
    {
        return Str::limit(strip_tags($this->content), $length);
    }
}
