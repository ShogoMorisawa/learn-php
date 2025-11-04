<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    // 過去1ヶ月の人気な本
    public function scopePopularLastMonth(Builder $query, int $minReviews = 2): Builder
    {
        $from = now()->subMonth();
        $to = now();

        return $query
            ->popular($from, $to, $minReviews)           // 件数条件とカウント集計、件数順ソート
            ->highestRated($from, $to)                   // 平均評価を計算
            ->orderByDesc('reviews_count');               // 「人気順」を明示
    }

    // 過去6ヶ月の人気な本
    public function scopePopularLast6Months(Builder $query, int $minReviews = 5): Builder
    {
        $from = now()->subMonths(6);
        $to = now();

        return $query
            ->popular($from, $to, $minReviews)           // 件数条件とカウント集計、件数順ソート
            ->highestRated($from, $to)                   // 平均評価を計算
            ->orderByDesc('reviews_count');               // 「人気順」を明示
    }

    // 過去1ヶ月の平均評価が高い本
    public function scopeHighestRatedLastMonth(Builder $query, int $minReviews = 2): Builder
    {
        $from = now()->subMonth();
        $to = now();

        return $query
            ->popular($from, $to, $minReviews)           // 件数条件とカウント集計
            ->highestRated($from, $to)                   // 平均評価を計算
            ->orderByDesc('reviews_avg_rating');         // 「平均評価順」を明示
    }

    // 過去6ヶ月の平均評価が高い本
    public function scopeHighestRatedLast6Months(Builder $query, int $minReviews = 5): Builder
    {
        $from = now()->subMonths(6);
        $to = now();

        return $query
            ->popular($from, $to, $minReviews)           // 件数条件とカウント集計
            ->highestRated($from, $to)                   // 平均評価を計算
            ->orderByDesc('reviews_avg_rating');         // 「平均評価順」を明示
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
