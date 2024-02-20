import './bootstrap';

import '../assets/vendor/slick/slick.min.css'
import '../assets/vendor/slick/slick-theme.min.css'
import '../assets/vendor/fontawesome-free/css/all.min.css';

import '../css/base.css'
import '../css/Extensions/_cards.css'
import '../css/Extensions/_buttons.css'
import '../css/Extensions/_cols.css'
import '../css/Extensions/_forms.css'
import '../css/custom.css';

import '../assets/vendor/jquery/jquery.min'
import '../assets/vendor/bootstrap/js/bootstrap.bundle.min'
import '../assets/vendor/jquery-easing/jquery.easing.min'
import '../assets/vendor/slick/slick.min'

import { createSSRApp, h } from 'vue';
import { renderToString } from '@vue/server-renderer';
import { createInertiaApp } from '@inertiajs/vue3';
import createServer from '@inertiajs/vue3/server';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import VueLazyLoad from 'vue3-lazyload';



createServer((page) =>
    createInertiaApp({
        page,
        render: renderToString,
        title: (title) => `${title}`,
        resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
        setup({ App, props, plugin }) {
            return createSSRApp({ render: () => h(App, props) })
                .use(plugin)
                .use(VueLazyLoad)
        },
    })
);
