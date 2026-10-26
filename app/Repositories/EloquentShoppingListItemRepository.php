<?php

namespace App\Repositories;

use App\Contracts\ShoppingListItemRepositoryInterface;
use App\Models\ShoppingList;
use App\Models\ShoppingListItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class EloquentShoppingListItemRepository implements ShoppingListItemRepositoryInterface
{
    public function getByShoppingList(ShoppingList $shoppingList): Collection
    {
        return $shoppingList->items()->get();
    }

    public function createForShoppingList(ShoppingList $shoppingList,array $data): ShoppingListItem 
    {
        return $shoppingList->items()->create($data);
    }

    public function existsByName(ShoppingList $shoppingList, string $name): bool
    {
        return $shoppingList->items()
            ->whereRaw('LOWER(name) = ?', [mb_strtolower($name)])
            ->exists();
    }

    public function delete(ShoppingListItem $item): bool
    {
        return (bool) $item->delete();
    }

    public function updatePurchasedStatus(ShoppingListItem $item, bool $isPurchased): bool
    {
        return $item->update(['is_purchased' => $isPurchased]);
    }

    public function getNextSortOrder(ShoppingList $shoppingList): int
    {
        return (int) $shoppingList->items()->max('sort_order') + 1;
    }

    
    public function reorderItems(ShoppingList $shoppingList, array $itemUuids): void
    {
        DB::transaction(function () use ($shoppingList, $itemUuids) {
            foreach ($itemUuids as $index => $uuid) {
                $shoppingList->items()
                    ->where('uuid', $uuid)
                    ->update(['sort_order' => $index + 1]);
            }
        });
    }

}
