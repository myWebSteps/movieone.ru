import './bootstrap';

import '../assets/vendor/slick/slick.min.css'
import '../assets/vendor/slick/slick-theme.min.css'
import '../assets/vendor/fontawesome-free/css/all.min.css';
import '../assets/css/osahan.css';
import '../css/app.css';

import '../assets/vendor/jquery/jquery.min'
import '../assets/vendor/bootstrap/js/bootstrap.bundle.min'
import '../assets/vendor/jquery-easing/jquery.easing.min'
import '../assets/vendor/slick/slick.min'



import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import VueLazyLoad from 'vue3-lazyload';


createInertiaApp({
    title: (title) => `${title}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(VueLazyLoad)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
