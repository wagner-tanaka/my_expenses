<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{

    // protected static function booted()
    // {
    //     static::addGlobalScope(new UserScope);
    // }

    use HasFactory;

    protected $guarded = [];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeThisMonth($query)
    {
       return $query->whereYear('created_at', now()->format('Y'))
            ->whereMonth('created_at', now()->format('m'));
    }
}
