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


}
