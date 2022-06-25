<?php

namespace App\Models;

use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class MonthExpensesCategory extends Model
{

    protected static function booted()
    {
        static::addGlobalScope(new UserScope);
    }

    use HasFactory;
    protected $guarded = [];

    public static function generateMonthExpensesForThisCategory(): void
    {

//        $dateStart =now()->startOfMonth()->subMonth();  // 2021-06-01
//        $dateEnd =now()->startOfMonth();   // 2021-07-01
        $expenses = MonthExpense::where('is_fixed',true)
            ->groupBy('name')
//            ->whereBetween('created_at', [$dateStart, $dateEnd])
            ->get();
        $expenses->each(function ($expense) {
            MonthExpense::create([
                'user_id' => Auth::id(),
                'month_expenses_category_id' => $expense->month_expenses_category_id,
                'is_fixed' => true,
                'name' => $expense->name,
                'value' => $expense->value,
                'pay_day' => $expense->pay_day
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
        return $this->monthExpenses()->thisMonth()->sum('value');
    }

}
