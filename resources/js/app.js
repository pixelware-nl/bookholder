import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import DefaultLayout from './Layouts/DefaultLayout.vue';
import AdminLayout from './Layouts/AdminLayout.vue';
import { ZiggyVue } from 'ziggy-js';

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        let page = pages[`./Pages/${name}.vue`]

        if (name.split('/')[0] === 'Admin') {
            page.default.layout = AdminLayout
        } else {
            page.default.layout = DefaultLayout
        }

        return page
    },
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(ZiggyVue)
            .use(plugin)
            .mount(el)
    },
});
