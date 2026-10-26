<?php

namespace App\Http\Controllers;

use App\Models\ShoppingList;
use App\Services\ShoppingListService;
use App\Services\ShoppingListItemService;
use App\Http\Requests\ShoppingListStoreRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShoppingListController extends Controller
{
    public function __construct(
        private readonly ShoppingListService $shoppingListService,
        private readonly ShoppingListItemService $shoppingListItemService
    ) {}

    public function index(Request $request): View
    {
        $shoppingLists = $this->shoppingListService->getUserLists($request->user());

        return view('shopping-lists.index', compact('shoppingLists'));
    }

    
    public function store(ShoppingListStoreRequest $request): RedirectResponse
    {
        $this->shoppingListService->createList($request->user(), $request->validated());

        return redirect()->route('shopping-lists.index')->with('success', 'Shopping list created successfully.');
    }

    public function show(Request $request, ShoppingList $shoppingList): View
    {
        abort_unless($shoppingList->user_id === $request->user()->id, 403);

        $items = $this->shoppingListItemService->getItems($shoppingList);

        $grandTotal = $this->shoppingListItemService->calculateTotal($shoppingList);

        return view('shopping-lists.show', compact('shoppingList', 'items', 'grandTotal'));
    }

}
