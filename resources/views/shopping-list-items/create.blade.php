@extends('layouts.app')

@section('title', 'Add Grocery Item')

@section('content')
<div class="container">

    <h2>Add Grocery Item</h2>

    <p>Shopping List: {{ $shoppingList->name }}</p>

    <p>
        <a href="{{ route('shopping-lists.show', $shoppingList) }}">Back to Shopping List</a>
    </p>

    <form action="{{ route('shopping-lists.items.store', $shoppingList) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Item Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="e.g. Milk" maxlength="255" required>

            @error('name')
                <div class="validation-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" id="quantity" name="quantity" value="{{ old('quantity', 1) }}" min="1" step="1" required>

            @error('quantity')
                <div class="validation-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="price">Price per Unit (£)</label>
            <input type="number" id="price" name="price" value="{{ old('price', '0.00') }}" min="0" step="0.01" required>

            @error('price')
                <div class="validation-error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Save Grocery Item</button>
    </form>

</div>
@endsection
