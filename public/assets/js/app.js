
document.addEventListener('DOMContentLoaded', () => {
    const table = document.getElementById('grocery-items-table');

    if (!table) return;

    const tbody = table.querySelector('tbody');
    const reorderUrl = table.dataset.reorderUrl;
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

    let draggedRow = null;
    let originalOrder = [];

    const getOrder = () => Array.from(tbody.querySelectorAll('tr[data-item-uuid]'))
        .map(row => row.dataset.itemUuid);

    tbody.querySelectorAll('.drag-handle').forEach(handle => {
        handle.addEventListener('dragstart', event => {
            draggedRow = handle.closest('tr');
            originalOrder = getOrder();

            draggedRow.classList.add('dragging');
            event.dataTransfer.effectAllowed = 'move';
            event.dataTransfer.setData('text/plain', draggedRow.dataset.itemUuid);
        });

        handle.addEventListener('dragend', async () => {
            if (!draggedRow) return;

            draggedRow.classList.remove('dragging');

            const newOrder = getOrder();
            draggedRow = null;

            if (JSON.stringify(originalOrder) === JSON.stringify(newOrder)) return;

            try {
                const response = await fetch(reorderUrl, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ items: newOrder })
                });

                if (!response.ok) throw new Error('Unable to save item order.');

            } catch (error) {
                originalOrder.forEach(uuid => {
                    const row = Array.from(tbody.querySelectorAll('tr[data-item-uuid]'))
                        .find(row => row.dataset.itemUuid === uuid);

                    if (row) tbody.appendChild(row);
                });

                alert('Unable to save the new order. Please try again.');
                console.error(error);
            }
        });
    });

    tbody.addEventListener('dragover', event => {
        if (!draggedRow) return;

        event.preventDefault();

        const targetRow = event.target.closest('tr[data-item-uuid]');

        if (!targetRow || targetRow === draggedRow) return;

        const middle = targetRow.getBoundingClientRect().top + targetRow.offsetHeight / 2;

        tbody.insertBefore(draggedRow, event.clientY < middle ? targetRow : targetRow.nextSibling);
    });
});
