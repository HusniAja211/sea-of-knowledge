import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                    primary: "#1E40AF", // Primary brand color → digunakan untuk navbar, primary button, link utama, dan elemen identitas brand
                    secondary: "#0F172A", // Secondary / strong section → digunakan untuk footer, hero section gelap, background section penting, dan text kontras tinggi
                    tertiary: "#14B8A6", // Supporting color → digunakan untuk badge, hover state, highlight kategori, dan elemen UI sekunder
                    accent: "#F97316", // Accent / CTA color → digunakan untuk tombol aksi utama seperti "Add to Cart", "Buy Now", promo, dan elemen yang perlu menarik perhatian
                    background: "#F1F5F9" // Background color → digunakan untuk background halaman, section ringan, container, agar UI terlihat bersih dan mudah dibaca
            }
        },
    },

    plugins: [forms],
};
