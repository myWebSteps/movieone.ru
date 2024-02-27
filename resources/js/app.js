import './bootstrap';

import '../assets/vendor/slick/slick.min.css'
import '../assets/vendor/slick/slick-theme.min.css'
import '../assets/vendor/fontawesome-free/css/all.min.css';

import '../css/base.css'
import '../css/Extensions/_cards.css'
import '../css/Extensions/_buttons.css'
import '../css/Extensions/_cols.css'
import '../css/Extensions/_forms.css'
import '../css/Extensions/_nav_bars.css';
import '../css/custom.css';


import '../assets/vendor/jquery/jquery.min'
import '../assets/vendor/bootstrap/js/bootstrap.bundle.min'
import '../assets/vendor/jquery-easing/jquery.easing.min'
import '../assets/vendor/slick/slick.min'



import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import VueLazyLoad from 'vue3-lazyload';
import VueYandexMetrika from 'vue-yandex-metrika';



createInertiaApp({
    title: (title) => `${title}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(VueLazyLoad)
            .use(VueYandexMetrika, {
                id: 94438576,
                // other options
            })
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
