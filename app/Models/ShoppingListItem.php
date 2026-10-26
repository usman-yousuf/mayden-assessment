<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShoppingListItem extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'quantity',
        'price',
        'is_purchased',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'price' => 'decimal:2',
            'is_purchased' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function shoppingList(): BelongsTo
    {
        return $this->belongsTo(ShoppingList::class);
    }
}
