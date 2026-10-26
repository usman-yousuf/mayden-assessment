<?php

namespace App\Repositories;

use App\Contracts\ShoppingListRepositoryInterface;
use App\Models\ShoppingList;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class EloquentShoppingListRepository implements ShoppingListRepositoryInterface
{
    public function getByUser(User $user): Collection
    {
        return $user->shoppingLists()
            ->latest()
            ->get();
    }

    public function createForUser(User $user, array $data): ShoppingList
    {
        return $user->shoppingLists()->create($data);
    }
}
