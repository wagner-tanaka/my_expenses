<?php

namespace App\Models;

use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MonthEarningsCategory extends Model
{

    protected static function booted()
    {
        static::addGlobalScope(new UserScope);
    }

    use HasFactory;
    protected $guarded = [];

    public static function generateMonthEarningsForThisCategory(): void
    {
        $dateStart =now()->startOfMonth()->subMonth();  // 2021-06-01
        $dateEnd =now()->startOfMonth();   // 2021-07-01
        $expenses = MonthEarning::where('is_fixed',true)
            ->groupBy('name')
            ->whereBetween('created_at', [$dateStart, $dateEnd])
            ->get();

        $expenses->each(function ($expense) {
            MonthEarning::create([
                'category_id' => $expense->category->id,
                'is_fixed' => true,
                'name' => $expense->name,
                'value' => 0
            ]);
        });
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function monthEarnings(): HasMany
    {
        return $this->hasMany(MonthEarning::class);
    }

    public function getMonthEarningsCategoryTotalAttribute()
    {
        return $this->monthEarnings()->sum('value');
    }

}
