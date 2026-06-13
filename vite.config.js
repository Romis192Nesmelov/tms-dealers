import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/main.css',

                'resources/css/icons/fontawesome/styles.min.css',
                'resources/css/icons/icomoon/styles.css',

                'resources/css/admin/admin.css',
                'resources/css/admin/bootstrap.css',
                'resources/css/admin/bootstrap-switch.css',
                'resources/css/admin/bootstrap-toggle.min.css',
                'resources/css/admin/core.css',
                'resources/css/admin/components.css',
                'resources/css/admin/colors.css',
                'resources/css/admin/loader.css',
                'resources/css/admin/admin.css',

                'resources/js/app.js',
                'resources/js/helper.js',
                'resources/js/main.js',

                'resources/js/admin/jquery.js',
                'resources/js/admin/tools.js',
                'resources/js/admin/bootstrap.min.js',
                'resources/js/admin/styling/uniform.min.js',
                'resources/js/admin/styling/switchery.min.js',
                'resources/js/admin/styling/bootstrap-switch.js',
                'resources/js/admin/styling/bootstrap-toggle.min.js',
                'resources/js/admin/login.js',
                'resources/js/admin/app.js',
                'resources/js/admin/admin.js',
            ],
            refresh: true,
            fonts: [
                bunny('Instrument Sans', {
                    weights: [400, 500, 600],
                }),
            ],
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
