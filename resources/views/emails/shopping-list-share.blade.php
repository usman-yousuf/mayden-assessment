<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shared Shopping List</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; padding: 20px;">

    <h2>Shopping List: {{ $shoppingList->name }}</h2>

    <p>A shopping list has been shared with you.</p>

    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th style="padding: 10px; border: 1px solid #ddd;">Item</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Quantity</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Unit Price</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Total</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($shoppingList->items as $item)
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">{{ $item->name }}</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">{{ $item->quantity }}</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">£{{ number_format($item->price, 2) }}</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">£{{ number_format($item->quantity * $item->price, 2) }}</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">
                        {{ $item->is_purchased ? 'Purchased' : 'Pending' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>
        Grand Total:
        £{{ number_format($shoppingList->items->sum(fn ($item) => $item->quantity * $item->price), 2) }}
    </h3>

    @if ($shoppingList->budget_limit !== null)
        <p><strong>Budget Limit:</strong> £{{ number_format($shoppingList->budget_limit, 2) }}</p>
    @endif

    <p style="margin-top: 25px; color: #666; font-size: 12px;">
        This shopping list was shared with you by email.
    </p>

</body>
</html>
