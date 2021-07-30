<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MonthExpense extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function monthExpenseCategory(): BelongsTo
    {
        return $this->belongsTo(MonthExpensesCategory::class);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereYear('created_at', now()->format('Y'))
            ->whereMonth('created_at', now()->format('m'));
    }

}
