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
        return $this->expenses()->get()->groupBy('name')->map(function ($expenses) {
            return [
                'name' => $expenses[0]->name,
                'value' => $expenses->sum('value')
            ];
            // return $expenses->sum('value');
        });
    }
}
