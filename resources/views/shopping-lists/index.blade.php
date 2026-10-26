@extends('layouts.app')

@section('title', 'My Shopping Lists')

@section('content')
<div class="container">

    <h2>My Shopping Lists</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h3>Create a Shopping List</h3>

    <form action="{{ route('shopping-lists.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Shopping List Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="e.g. Weekly Groceries" required maxlength="255">

            @error('name')
                <div class="validation-error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create List</button>
    </form>

    <h3>Your Shopping Lists</h3>

    @if ($shoppingLists->isEmpty())
        <p>You don't have any shopping lists yet.</p>
    @else
        <ul>
            @foreach ($shoppingLists as $shoppingList)
                 <li>
                    <a href="{{ route('shopping-lists.show', $shoppingList) }}">
                        {{ $shoppingList->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif

</div>
@endsection
