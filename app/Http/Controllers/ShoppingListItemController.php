<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShoppingListItemStoreRequest;
use App\Models\ShoppingList;
use App\Services\ShoppingListItemService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShoppingListItemController extends Controller
{
    public function __construct(private readonly ShoppingListItemService $shoppingListItemService) {}

    
    public function create(Request $request, ShoppingList $shoppingList): View
    {
        abort_unless((int) $shoppingList->user_id === (int) $request->user()->id, 403);

        return view('shopping-list-items.create', compact('shoppingList'));
    }


    public function store(ShoppingListItemStoreRequest $request, ShoppingList $shoppingList): RedirectResponse
    {
        abort_unless($shoppingList->user_id === $request->user()->id, 403);

        $this->shoppingListItemService->createItem($shoppingList, $request->validated());

        return redirect()->route('shopping-lists.show', $shoppingList)->with('success', 'Grocery item added successfully.');
    }
}
