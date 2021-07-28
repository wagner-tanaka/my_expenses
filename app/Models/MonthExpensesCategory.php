<?php

namespace App\Models;

use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthExpensesCategory extends Model
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

    public function monthExpenses()
    {
        return $this->hasMany(MonthExpense::class);
    }

    public function getMonthExpensesTotalAttribute()
    {
        return $this->monthExpenses()->sum('value');
    }

}
