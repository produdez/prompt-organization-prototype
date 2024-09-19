import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

// TODO: check later
// !NOTE: currently there's no tailwind config, but it still works so maybe it's not needed?
export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/filament/admin/theme.css'],
            refresh: true,
        }),
    ],
});
