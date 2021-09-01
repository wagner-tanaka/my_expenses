<?php

namespace App\Models;

use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    use HasFactory;

    protected $guarded = [];

//    protected static function booted()
//    {
//        static::addGlobalScope(new UserScope);
//    }

    // Scopes
    public function scopeForDate(Builder $query, $date): Builder
    {
        $year = explode('-', $date)[0];
        $month = explode('-', $date)[1];
        return $query->whereYear('created_at', $year)->whereMonth('created_at', $month);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereYear('created_at', now()->format('Y'))->whereMonth('created_at', now()->format('m'));
    }

    public function scopeMonthFiltered($query, $year, $month)
    {
        return $query->whereYear('created_at', $year)->whereMonth('created_at', $month);
    }

    public function scopePreviousMonth($query)
    {
        return $query->whereYear('created_at', now()->format('Y'))
            ->whereMonth('created_at', now()->format('m'));
    }

    // Relations
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}
