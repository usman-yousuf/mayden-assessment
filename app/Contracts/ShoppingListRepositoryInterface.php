<?php

namespace App\Contracts;

use App\Models\ShoppingList;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface ShoppingListRepositoryInterface
{
    public function getByUser(User $user): Collection;

    public function createForUser(User $user, array $data): ShoppingList;
}