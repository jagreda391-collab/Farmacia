<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['customer_id', 'user_id', 'date', 'total', 'igv'])]
class Sale extends Model
{
    protected function casts(): array
    {
        return [
            'date' => 'datetime',
            'total' => 'decimal:2',
            'igv' => 'decimal:2',
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(DetailSale::class);
    }

    public function calculateTotal(): float
    {
        $this->total = round($this->details()->sum('subtotal'), 2);
        $this->igv = round($this->total - $this->total / 1.18, 2);
        return (float) $this->total;
    }
}