import Swal from 'sweetalert2'
window.Swal = Swal

function alertSuccess(message) {
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: message,
        confirmButtonColor: '#16a34a',
        confirmButtonText: 'OK',
    })
}

function alertError(message) {
    Swal.fire({
        icon: 'error',
        title: 'Failed',
        text: message,
        confirmButtonColor: '#dc2626',
        confirmButtonText: 'OK',
    })
}

function alertWarning(message) {
    Swal.fire({
        icon: 'warning',
        title: 'Warning',
        text: message,
        confirmButtonColor: '#f59e0b',
        confirmButtonText: 'Mengerti',
    })
}

function confirmDelete(url) {
    Swal.fire({
        title: 'Are you sure you want to delete?',
        text: 'Deleted data cannot be recovered!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, delete',
        cancelButtonText: 'Cancel',
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.createElement('form')
            form.method = 'POST'
            form.action = url

            const csrf = document.createElement('input')
            csrf.type = 'hidden'
            csrf.name = '_token'
            csrf.value = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content')

            const method = document.createElement('input')
            method.type = 'hidden'
            method.name = '_method'
            method.value = 'DELETE'

            form.appendChild(csrf)
            form.appendChild(method)
            document.body.appendChild(form)
            form.submit()
        }
    })
}

function alertLoading(
    title = 'Processing...',
    text = 'Please wait a moment'
) {
    Swal.fire({
        title: title,
        text: text,
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading()
        }
    })
}

// function confirmReceived(orderId) {
//     Swal.fire({
//         title: 'Confirm Order Received?',
//         text: 'Make sure you have received the package.',
//         icon: 'question',
//         showCancelButton: true,
//         confirmButtonColor: '#16a34a',
//         cancelButtonColor: '#6b7280',
//         confirmButtonText: 'Yes, I have received it',
//         cancelButtonText: 'Cancel',
//     }).then((result) => {
//         if (result.isConfirmed) {

//             alertLoading('Updating...', 'Please wait');

//             document
//                 .getElementById('received-form-' + orderId)
//                 .submit();
//         }
//     });
// }

// function confirmRefund(orderId) {
//     Swal.fire({
//         title: 'Request Refund?',
//         text: 'Are you sure you want to request a refund?',
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#dc2626',
//         cancelButtonColor: '#6b7280',
//         confirmButtonText: 'Yes, request refund',
//         cancelButtonText: 'Cancel',
//     }).then((result) => {
//         if (result.isConfirmed) {
//             alertLoading('Submitting...', 'Please wait');
//             document
//                 .getElementById('refund-form-' + orderId)
//                 .submit();
//         }
//     });
// }

/**
 * 
 * Expose ke global agar bisa dipakai di Blade
 */
window.alertSuccess = alertSuccess
window.alertError = alertError
window.alertWarning = alertWarning
window.confirmDelete = confirmDelete
window.alertLoading = alertLoading
// window.confirmReceived = confirmReceived;
// window.confirmRefund = confirmRefund;