document.addEventListener('DOMContentLoaded', () => {

    const checkboxes = document.querySelectorAll('.cart-item-checkbox');
    const selectAll  = document.getElementById('select-all');

    const summaryQty   = document.getElementById('summary-qty');
    const summaryTotal = document.getElementById('summary-total');
    const summaryGrand = document.getElementById('summary-grand-total');

    const checkoutQty   = document.getElementById('checkout-qty');
    const checkoutTotal = document.getElementById('checkout-total');

    const checkoutBtn   = document.getElementById('checkout-btn');
    const modal         = document.getElementById('checkout-modal');
    const closeModal    = document.getElementById('close-checkout');

    const selectedInput = document.getElementById('selected-items-input');

    function formatRupiah(number) {
        return 'Rp ' + Number(number).toLocaleString('id-ID');
    }

    function calculateSummary() {
        let total = 0;
        let qty   = 0;

        checkboxes.forEach(cb => {
            if (cb.checked) {
                const price = parseInt(cb.dataset.price);
                const q     = parseInt(cb.dataset.qty);

                total += price * q;
                qty   += q;
            }
        });

        summaryQty.textContent   = qty;
        summaryTotal.textContent = formatRupiah(total);
        summaryGrand.textContent = formatRupiah(total);

        checkoutQty.textContent   = qty;
        checkoutTotal.textContent = formatRupiah(total);
    }

    function updateSelectedItems() {
        const selectedIds = [];

        checkboxes.forEach(cb => {
            if (cb.checked) {
                selectedIds.push(cb.value);
            }
        });

        selectedInput.value = JSON.stringify(selectedIds);
    }

    // Checkbox change
    checkboxes.forEach(cb => {
        cb.addEventListener('change', () => {
            calculateSummary();
            updateSelectedItems();
        });
    });

    // Select all
    if (selectAll) {
        selectAll.addEventListener('change', () => {
            checkboxes.forEach(cb => {
                cb.checked = selectAll.checked;
            });

            calculateSummary();
            updateSelectedItems();
        });
    }

    // Checkout button → buka modal
    checkoutBtn.addEventListener('click', () => {

        const selectedIds = JSON.parse(selectedInput.value || '[]');

        if (selectedIds.length === 0) {
            alert('Please select at least one item.');
            return;
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    });

    // Close modal
    closeModal.addEventListener('click', () => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    });

    // Init
    calculateSummary();
    updateSelectedItems();
});