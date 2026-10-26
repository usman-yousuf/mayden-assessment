<?php

namespace App\Services;

use App\Contracts\ShoppingListItemRepositoryInterface;
use App\Models\ShoppingList;
use App\Models\ShoppingListItem;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\Collection;

class ShoppingListItemService
{
    public function __construct(
        private readonly ShoppingListItemRepositoryInterface $repository
    ) {}

    public function getItems(ShoppingList $shoppingList): Collection
    {
        return $this->repository->getByShoppingList($shoppingList);
    }

    
    public function createItem(ShoppingList $shoppingList, array $data): ShoppingListItem
    {
        $data['name'] = trim($data['name']);

        if ($this->repository->existsByName($shoppingList, $data['name'])) {
            throw ValidationException::withMessages([
                'name' => 'This item already exists on your shopping list.',
            ]);
        }

        $data['sort_order'] = $this->repository->getNextSortOrder($shoppingList);

        return $this->repository->createForShoppingList($shoppingList, $data);
    }


    public function deleteItem(ShoppingListItem $item): bool
    {
        return $this->repository->delete($item);
    }

    
    public function updatePurchasedStatus(ShoppingListItem $item, bool $isPurchased): bool
    {
        return $this->repository->updatePurchasedStatus($item, $isPurchased);
    }


    
    public function reorderItems(ShoppingList $shoppingList, array $itemUuids): void
    {
        $existingUuids = $this->repository->getByShoppingList($shoppingList)
            ->pluck('uuid')
            ->all();

        if (count($itemUuids) !== count($existingUuids) || count($itemUuids) !== count(array_unique($itemUuids)) || array_diff($itemUuids, $existingUuids)) {
            throw ValidationException::withMessages([
                'items' => 'Invalid grocery item order.',
            ]);
        }

        $this->repository->reorderItems($shoppingList, $itemUuids);
    }

}
