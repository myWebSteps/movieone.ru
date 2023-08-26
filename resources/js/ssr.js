import './bootstrap';

import '../assets/css/osahan.css';
import '../assets/vendor/fontawesome-free/css/all.min.css';
import '../assets/AdminLte/dist/css/adminlte.min.css';

import '../assets/vendor/jquery/jquery.min'
import '../assets/vendor/bootstrap/js/bootstrap.bundle.min'
import '../assets/vendor/jquery-easing/jquery.easing.min'
import '../assets/AdminLte/dist/js/adminlte'

import '../css/app.css';


import { createSSRApp, h } from 'vue';
import { renderToString } from '@vue/server-renderer';
import { createInertiaApp } from '@inertiajs/vue3';
import createServer from '@inertiajs/vue3/server';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createServer((page) =>
    createInertiaApp({
        page,
        render: renderToString,
        title: (title) => `${title} - ${appName}`,
        resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
        setup({ App, props, plugin }) {
            return createSSRApp({ render: () => h(App, props) })
                .use(plugin)
                .use(ZiggyVue, {
                    ...page.props.ziggy,
                    location: new URL(page.props.ziggy.location),
                });
        },
    })
);
