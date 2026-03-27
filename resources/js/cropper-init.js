import Cropper from 'cropperjs';
import 'cropperjs/dist/cropper.css';

document.addEventListener('DOMContentLoaded', function () {

    const input = document.getElementById('pfp');
    const preview = document.getElementById('image-preview');

    const modal = document.getElementById('cropper-modal');
    const cropperImage = document.getElementById('cropper-image');

    const closeBtn = document.getElementById('close-modal');
    const cropBtn = document.getElementById('crop-btn');

    const cropDataInput = document.getElementById('crop_data');

    let cropper;

    // 📌 OPEN MODAL
    input.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = () => {
            cropperImage.src = reader.result;

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            if (cropper) cropper.destroy();

            cropper = new Cropper(cropperImage, {
                aspectRatio: 1,
                viewMode: 1,
                autoCropArea: 1,
                background: false,
                responsive: true,
                guides: false,
                center: true,
                highlight: false,

                 ready() {
                    // 🔥 FORCE STYLE SETELAH RENDER
                    const viewBox = document.querySelector('.cropper-view-box');
                    const face = document.querySelector('.cropper-face');

                    if (viewBox) {
                        viewBox.style.borderRadius = '50%';
                        viewBox.style.overflow = 'hidden';
                        viewBox.style.boxShadow = '0 0 0 9999px rgba(0,0,0,0.5)';
                    }

                    if (face) {
                        face.style.borderRadius = '50%';
                    }
                }
            });
        };

        reader.readAsDataURL(file);
    });

    // ❌ CLOSE MODAL
    closeBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');

        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
    });

    // ✅ CROP IMAGE
    cropBtn.addEventListener('click', () => {
        if (!cropper) return;

        const croppedCanvas = cropper.getCroppedCanvas({
            width: 300,
            height: 300,
        });

        const size = 300;

        // 🔥 BUAT CANVAS BARU
        const roundedCanvas = document.createElement('canvas');
        roundedCanvas.width = size;
        roundedCanvas.height = size;

        const ctx = roundedCanvas.getContext('2d');

        // 🔥 bikin clipping lingkaran
        ctx.beginPath();
        ctx.arc(size / 2, size / 2, size / 2, 0, Math.PI * 2);
        ctx.closePath();
        ctx.clip();

        // 🔥 baru gambar image
        ctx.drawImage(croppedCanvas, 0, 0, size, size);

        const base64 = roundedCanvas.toDataURL('image/png');

        cropDataInput.value = base64;
        preview.src = base64;

        modal.classList.add('hidden');
        modal.classList.remove('flex');

        cropper.destroy();
        cropper = null;
    });

});