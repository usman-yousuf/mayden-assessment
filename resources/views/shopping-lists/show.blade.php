
@extends('layouts.app')

@section('title', $shoppingList->name)

@section('content')
<div class="container">

    <h2>{{ $shoppingList->name }}</h2>

    <p>
        <a href="{{ route('shopping-lists.index') }}">Back to My Shopping Lists</a>
    </p>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <p>
        <a href="{{ route('shopping-lists.items.create', $shoppingList) }}" class="btn btn-primary">Add Grocery Item</a>
    </p>

    <h3>Grocery Items</h3>

    @if ($items->isEmpty())
        <p>No grocery items have been added to this list yet.</p>
    @else
        <div class="table-responsive">
           <table class="table" id="grocery-items-table" data-reorder-url="{{ route('shopping-lists.items.reorder', $shoppingList) }}">
                <thead>
                    <tr>
                        <th>Move</th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($items as $item)
                         <tr data-item-uuid="{{ $item->uuid }}">
                            <td class="drag-handle" draggable="true" title="Drag to reorder">⠿</td>
                            <td>
                                <span style="{{ $item->is_purchased ? 'text-decoration: line-through; color: #888;' : '' }}">
                                    {{ $item->name }}
                                </span>
                            </td>
                            <td>{{ $item->quantity }}</td>
                            <td>£{{ number_format($item->price, 2) }}</td>
                            <td>£{{ number_format($item->quantity * $item->price, 2) }}</td>
                            <td>{{ $item->is_purchased ? 'Purchased' : 'Pending' }}</td>
                            <td>
                                <form action="{{ route('shopping-lists.items.purchased', [$shoppingList, $item]) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('PATCH')

                                    <input type="hidden" name="is_purchased" value="{{ $item->is_purchased ? 0 : 1 }}">

                                    <button type="submit" class="btn btn-primary">
                                        {{ $item->is_purchased ? 'Mark as Pending' : 'Mark as Purchased' }}
                                    </button>
                                </form>

                                <form action="{{ route('shopping-lists.items.destroy', [$shoppingList, $item]) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this grocery item?');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-end"><strong>Grand Total:</strong></td>
                        <td><strong>£{{ number_format($grandTotal, 2) }}</strong></td>
                        <td colspan="2"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    @endif

</div>
@endsection
