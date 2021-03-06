<?php

namespace App\Models;

use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MonthEarning extends Model
{
    protected static function booted()
    {
        static::addGlobalScope(new UserScope);
    }

    public function scopeForDate(Builder $query, $date): Builder
    {
        $year = explode('-', $date)[0];
        $month = explode('-', $date)[1];
        return $query->whereYear('created_at', $year)->whereMonth('created_at', $month);
    }

    use HasFactory;
    protected $guarded = [];

    public function monthEarningCategory(): BelongsTo
    {
        return $this->belongsTo(MonthEarningsCategory::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereYear('created_at', now()->format('Y'))
            ->whereMonth('created_at', now()->format('m'));
    }

}
