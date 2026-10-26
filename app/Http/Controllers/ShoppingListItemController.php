<?php

namespace App\Http\Controllers;

use App\Models\ShoppingList;
use App\Models\ShoppingListItem;
use App\Services\ShoppingListItemService;
use App\Http\Requests\ShoppingListItemStoreRequest;
use App\Http\Requests\ShoppingListItemReorderRequest;
use Illuminate\Http\JsonResponse;
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

    
    public function destroy(Request $request, ShoppingList $shoppingList, ShoppingListItem $item): RedirectResponse
    {
        abort_unless((int) $shoppingList->user_id === (int) $request->user()->id, 403);

        abort_unless((int) $item->shopping_list_id === (int) $shoppingList->id, 404);

        $this->shoppingListItemService->deleteItem($item);

        return redirect()->route('shopping-lists.show', $shoppingList)->with('success', 'Grocery item deleted successfully.');
    }

    
    public function updatePurchasedStatus(Request $request, ShoppingList $shoppingList, ShoppingListItem $item): RedirectResponse
    {
        abort_unless((int) $shoppingList->user_id === (int) $request->user()->id, 403);

        abort_unless((int) $item->shopping_list_id === (int) $shoppingList->id, 404);

        $validated = $request->validate([
            'is_purchased' => ['required', 'boolean'],
        ]);

        $this->shoppingListItemService->updatePurchasedStatus($item, (bool) $validated['is_purchased']);

        return redirect()->route('shopping-lists.show', $shoppingList)->with('success', 'Grocery item status updated successfully.');
    }

    
    public function reorder(ShoppingListItemReorderRequest $request, ShoppingList $shoppingList): JsonResponse
    {
        abort_unless((int) $shoppingList->user_id === (int) $request->user()->id, 403);

        $this->shoppingListItemService->reorderItems($shoppingList, $request->validated('items'));

        return response()->json([
            'success' => true,
            'message' => 'Grocery items reordered successfully.',
        ]);
    }


}
