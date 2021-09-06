<?php

namespace App\Models;

use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    protected static function booted()
    {
        static::addGlobalScope(new UserScope);
    }

    public static function generateExpensesForThisCategory(): void
    {
        $dateStart =now()->startOfMonth()->subMonth();  // 2021-06-01
        $dateEnd =now()->startOfMonth();   // 2021-07-01
        $expenses = Expense::where('is_fixed',true)
            ->groupBy('name')
            ->whereBetween('created_at', [$dateStart, $dateEnd])
            ->get();
//        dd('$expenses', $expenses);
        $expenses->each(function ($expense) {
            Expense::create([
                'user_id' => Auth::user(),
                'category_id' => $expense->category_id,
                'is_fixed' => true,
                'name' => $expense->name,
                'value' => 0
            ]);
        });
    }

    use HasFactory;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    public function getTotalCategoryExpensesAttribute()
    {
        return $this->expenses()->thisMonth()->sum('value');
    }

    public function groupedExpenses()
    {
        return $this->expenses()->thisMonth()->get()->groupBy('name')->map(function ($expenses) {
            return [
                'name' => $expenses[0]->name,
                'value' => $expenses->sum('value')
            ];
        });
    }

    public function groupedExpensesFiltered($year, $month)
    {
        return $this->expenses()->monthFiltered($year, $month)->get()->groupBy('name')->map(function ($expenses) {
            return [
                'name' => $expenses[0]->name,
                'value' => $expenses->sum('value')
            ];
        });
    }
}
