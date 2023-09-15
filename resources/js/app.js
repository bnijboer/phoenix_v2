import "primevue/resources/themes/lara-light-purple/theme.css";
import "primevue/resources/primevue.min.css";
import "primeicons/primeicons.css";
import 'primeflex/primeflex.css';
import '../css/app.css';

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import PrimeVue from 'primevue/config';
import LayoutDefault from "@/pages/layout/layout-default.vue";
import route from "ziggy-js";

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./pages/**/*.vue', { eager: true })
        let page = pages[`./pages/${name}.vue`]
        page.default.layout = page.default.layout || LayoutDefault
        return page
    },
    setup({ el, App, props, plugin }) {
        createApp({
            render: () => h(App, props)
        })
        .mixin({
            methods: {
                route
            }
        })
        .use(PrimeVue)
        .use(plugin)
        .mount(el)
    },
});
