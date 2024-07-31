import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import DefaultLayout from './Layouts/DefaultLayout.vue';
import AdminLayout from './Layouts/AdminLayout.vue';
import { ZiggyVue } from 'ziggy-js';
import AuthLayout from "./Layouts/AuthLayout.vue";

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        let page = pages[`./Pages/${name}.vue`]
        let urlFirstElementName = name.split('/')[0]

        switch (urlFirstElementName) {
            case 'Admin':
                page.default.layout = AdminLayout
                break;
            case 'Auth':
                page.default.layout = AuthLayout
                break;
            default:
                page.default.layout = DefaultLayout
                break;
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
