<?php

namespace App\Services;

use App\Contracts\ShoppingListRepositoryInterface;
use App\Models\ShoppingList;
use App\Models\User;
use App\Mail\ShoppingListShareMail;
use Illuminate\Support\Facades\Mail;
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

    
    public function shareList(ShoppingList $shoppingList, string $email): void
    {
        $shoppingList->load('items');

        Mail::to($email)->send(new ShoppingListShareMail($shoppingList));
    }

}
