<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    // タイトルで検索
    public function scopeTitle(Builder $query, string $title): Builder
    {
        return $query->where('title', 'like', '%' . $title . '%');
    }

    // 指定期間のレビュー数を取得
    public function scopeWithReviewsCount(Builder $query, ?string $from = null, ?string $to = null): Builder
    {
        return $query->withCount([
            'reviews' => function (Builder $reviewQuery) use ($from, $to) {
                $this->applyReviewDateRange($reviewQuery, $from, $to);
            },
        ]);
    }

    // 指定期間のレビュー数を取得し、多い順に並べ替える
    public function scopePopular(
        Builder $query,
        ?string $from = null,
        ?string $to = null,
        ?int $minReviews = null,
        ?int $maxReviews = null
    ): Builder {
        $query = $query->withReviewsCount($from, $to);

        if ($minReviews !== null) {
            $query->having('reviews_count', '>=', $minReviews);
        }

        if ($maxReviews !== null) {
            $query->having('reviews_count', '<=', $maxReviews);
        }

        return $query->orderByDesc('reviews_count');
    }

    // 指定期間のレビュー数を取得し、指定レビュー数に満たないものを除外
    public function scopeWithMinReviews(
        Builder $query,
        ?int $minReviews,
        ?string $from = null,
        ?string $to = null
    ): Builder {
        return $query->withReviewsCount($from, $to)
            ->having('reviews_count', '>=', $minReviews);
    }

    // 指定期間の平均評価が高い順
    public function scopeHighestRated(
        Builder $query,
        ?string $from = null,
        ?string $to = null,
        ?int $minReviews = null
    ): Builder {
        $query = $query->withCount([
            'reviews' => function (Builder $reviewQuery) use ($from, $to) {
                $this->applyReviewDateRange($reviewQuery, $from, $to);
            },
        ])->withAvg([
            'reviews' => function (Builder $reviewQuery) use ($from, $to) {
                $this->applyReviewDateRange($reviewQuery, $from, $to);
            },
        ], 'rating');

        if ($minReviews !== null) {
            $query->having('reviews_count', '>=', $minReviews);
        }

        return $query->orderByDesc('reviews_avg_rating');
    }

    private function applyReviewDateRange(Builder $query, ?string $from, ?string $to): void
    {
        if ($from !== null && $to !== null) {
            $query->whereBetween('created_at', [$from, $to]);
            return;
        }

        if ($from !== null) {
            $query->where('created_at', '>=', $from);
        }

        if ($to !== null) {
            $query->where('created_at', '<=', $to);
        }
    }
}
