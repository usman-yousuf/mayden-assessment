<?php

namespace App\Services;

use App\Contracts\ShoppingListRepositoryInterface;
use App\Models\ShoppingList;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class ShoppingListService
{
    public function __construct(
        private readonly ShoppingListRepositoryInterface $repository
    ) {}

    public function getUserLists(User $user): Collection
    {
        return $this->repository->getByUser($user);
    }

    public function createList(User $user, array $data): ShoppingList
    {
        return $this->repository->createForUser($user, $data);
    }
}
