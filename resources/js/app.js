import './bootstrap';

import '../assets/css/osahan.css';
import '../assets/vendor/fontawesome-free/css/all.min.css';
import '../assets/AdminLte/dist/css/alt/adminlte.core.css';
import '../css/app.css';

import '../assets/vendor/jquery/jquery.min'
import '../assets/vendor/bootstrap/js/bootstrap.bundle.min'
import '../assets/vendor/jquery-easing/jquery.easing.min'
import '../assets/AdminLte/dist/js/adminlte'




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
