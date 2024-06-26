import {
    defineConfig
} from 'vite';
import laravel from 'laravel-vite-plugin';
const path = require('path') // <-- require path from node

export default defineConfig({
    plugins: [
        laravel({
            // edit the first value of the array input to point to our new sass files and folder.
            input: [
                'resources/scss/app.scss',
                'resources/js/app.js',
                'resources/js/image_preview.js',
                'resources/js/logo_preview.js',
                'resources/js/delete_confirmation.js',
                'resources/js/theme_toggle.js',
                'resources/js/register_validation.js',
                'resources/js/login_validation.js',
                'resources/js/forgot_password_validation.js',
                'resources/js/dish_forms_validation.js',
            ],
            refresh: true,
        }),
    ],
    // Add resolve object and aliases
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            '~resources': '/resources/'
        }
    }
});
