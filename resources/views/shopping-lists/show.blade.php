
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
            <table class="table">
                <thead>
                    <tr>
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
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>£{{ number_format($item->price, 2) }}</td>
                            <td>£{{ number_format($item->quantity * $item->price, 2) }}</td>
                            <td>{{ $item->is_purchased ? 'Purchased' : 'Pending' }}</td>
                            <td>—</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>
@endsection
