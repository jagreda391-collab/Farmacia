<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['sale_id', 'medicine_id', 'amount', 'price_unit', 'subtotal'])]
class DetailSale extends Model
{
    protected function casts(): array
    {
        return [
            'price_unit' => 'decimal:2',
            'subtotal' => 'decimal:2',
        ];
    }

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    public function medicine(): BelongsTo
    {
        return $this->belongsTo(Medicine::class);
    }

    public function calculateSubtotal(): float
    {
        return round($this->amount * $this->price_unit, 2);
    }

    public function validateStock(): bool
    {
        return $this->amount <= $this->medicine->stock;
    }
}