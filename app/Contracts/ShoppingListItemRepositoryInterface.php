<?php

namespace App\Contracts;

use App\Models\ShoppingList;
use App\Models\ShoppingListItem;
use Illuminate\Database\Eloquent\Collection;

interface ShoppingListItemRepositoryInterface
{
    public function getByShoppingList(ShoppingList $shoppingList): Collection;

    public function createForShoppingList(ShoppingList $shoppingList,array $data): ShoppingListItem;

    public function existsByName(ShoppingList $shoppingList, string $name): bool;
}
