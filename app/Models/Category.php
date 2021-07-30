<?php

namespace App\Models;

use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

        $expenses->each(function ($expense) {
            Expense::create([
                'category_id' => $expense->category->id,
                'is_fixed' => true,
                'name' => $expense->name,
                'value' => 0
            ]);
        });
    }

    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function getTotalCategoryExpensesAttribute()
    {
        return $this->expenses()->sum('value');
    }

    public function groupedExpenses()
    {
        return $this->expenses()->  thisMonth()->get()->groupBy('name')->map(function ($expenses) {
            return [
                'name' => $expenses[0]->name,
                'value' => $expenses->sum('value')
            ];
            // return $expenses->sum('value');
        });
    }
}
