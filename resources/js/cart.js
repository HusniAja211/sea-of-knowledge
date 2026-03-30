document.addEventListener('DOMContentLoaded', () => {
    const itemCheckboxes = document.querySelectorAll('.cart-item-checkbox');
    const selectAllCheckbox = document.getElementById('select-all');

    const qtyEl = document.getElementById('summary-qty');
    const subtotalEl = document.getElementById('summary-total');
    const grandTotalEl = document.getElementById('summary-grand-total');

    if (!itemCheckboxes.length) return;

    function formatRupiah(number) {
        return 'Rp' + Number(number).toLocaleString('id-ID');
    }

    function updateSummary() {
        let total = 0;
        let qty = 0;

        itemCheckboxes.forEach(cb => {
            if (cb.checked) {
                const price = Number(cb.dataset.price);
                const quantity = Number(cb.dataset.qty);

                total += price * quantity;
                qty += quantity;
            }
        });

        qtyEl.textContent = qty;
        subtotalEl.textContent = formatRupiah(total);
        grandTotalEl.textContent = formatRupiah(total);
    }

    function syncSelectAll() {
        if (!selectAllCheckbox) return;

        const checkedCount = [...itemCheckboxes].filter(cb => cb.checked).length;
        selectAllCheckbox.checked = checkedCount === itemCheckboxes.length;
        selectAllCheckbox.indeterminate =
            checkedCount > 0 && checkedCount < itemCheckboxes.length;
    }

    // Checkbox item
    itemCheckboxes.forEach(cb => {
        cb.addEventListener('change', () => {
            updateSummary();
            syncSelectAll();
        });
    });

    // Select all
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', () => {
            itemCheckboxes.forEach(cb => {
                cb.checked = selectAllCheckbox.checked;
            });
            updateSummary();
        });
    }

    // Initial state
    updateSummary();
});