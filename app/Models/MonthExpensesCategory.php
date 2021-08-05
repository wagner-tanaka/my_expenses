<?php

namespace App\Models;

use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MonthExpensesCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected static function booted()
    {
        static::addGlobalScope(new UserScope);
    }

    public static function generateMonthExpensesForThisCategory(): void
    {
        $dateStart =now()->startOfMonth()->subMonth();  // 2021-06-01
        $dateEnd =now()->startOfMonth();   // 2021-07-01
        $expenses = MonthExpense::where('is_fixed',true)
            ->groupBy('name')
            ->whereBetween('created_at', [$dateStart, $dateEnd])
            ->get();

        $expenses->each(function ($expense) {
            MonthExpense::create([
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

    public function monthExpenses(): HasMany
    {
        return $this->hasMany(MonthExpense::class);
    }

    public function getMonthExpensesCategoryTotalAttribute()
    {
        return $this->monthExpenses()->sum('value');
    }

}
