import "primevue/resources/themes/saga-blue/theme.css";
import "primevue/resources/primevue.min.css";
import "primeicons/primeicons.css";
import 'primeflex/primeflex.css';
import '../css/app.css';

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import PrimeVue from 'primevue/config';
import { createPinia } from 'pinia';
import LayoutDefault from "@/pages/layout/layout-default.vue";

const pinia = createPinia();

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./pages/**/*.vue', { eager: true })
        let page = pages[`./pages/${name}.vue`]
        page.default.layout = page.default.layout || LayoutDefault
        return page
    },
    setup({ el, App, props, plugin }) {
        // const VueApp = createApp({ render: () => h(app, props) });
        //
        // VueApp.config.globalProperties.$date = dayjs;
        //
        // VueApp.use(plugin)
        //     .use(PrimeVue)
        //     .mixin({ methods: { route } })
        //     .mount(el);

        createApp({ render: () => h(App, props) })
            .use(PrimeVue)
            .use(plugin)
            .mount(el)
    },
});

// app.use(pinia)
//     .use(vfmPlugin);
