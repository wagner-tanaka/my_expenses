<?php

namespace App\Models;

use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MonthEarning extends Model
{
    protected static function booted()
    {
        static::addGlobalScope(new UserScope);
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
