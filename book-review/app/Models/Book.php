<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Database\Eloquent\Builder as queryBuilder;

class Book extends Model
{
    use HasFactory;

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // use prefix "scope" for naming convention
    // php artisan tinker > \App\Models\Book::title('esse')->get();
    public function scopeTitle(Builder $query, string $title): Builder
    {
        return $query->where('title', 'like', '%' . $title . '%');
    }

    public function scopePopular(Builder $query, $from = null, $to = null): Builder
    {
        // fn is a shorthand for PHP 7.4 closure (function) **only 1 expression
        return $query->withCount([
            'reviews' => fn(Builder $q) => $this->dateRangeFilter($q, $from, $to)
        ])
            ->orderBy('reviews_count', 'desc');
    }

    public function scopeHighestRated(Builder $query, $from = null, $to = null): Builder
    {
        return $query->withAvg([
            'reviews' => fn(Builder $q) => $this->dateRangeFilter($q, $from, $to)
        ], 'rating')
            ->orderBy('reviews_avg_rating', 'desc');
    }

    // no need for return statement because it's pass by reference Builder $query >> dateRangeFilter($q ... )
    private function dateRangeFilter(Builder $query, $from = null, $to = null) {
        if ($from && !$to) {
            $query->where('created_at', '=>', $from);
        }
        elseif (!$from && $to) {
            $query->where('created_at', '<=', $to);
        }
        elseif ($from && $to) {
            $query->whereBetween('created_at', [$from, $to]);
        }
    }
}
