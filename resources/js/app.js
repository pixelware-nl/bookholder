import { createInertiaApp } from '@inertiajs/vue3';
import { i18nVue } from 'laravel-vue-i18n';
import { createApp, h } from 'vue';
import { ZiggyVue } from 'ziggy-js';
import { FontAwesomeIcon } from './../ts/font-awesome.ts';
import AdminLayout from './Layouts/AdminLayout.vue';
import AuthLayout from './Layouts/AuthLayout.vue';

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });
        let page = pages[`./Pages/${name}.vue`];
        let urlFirstElementName = name.split('/')[0];

        switch (urlFirstElementName) {
            case 'Admin':
                page.default.layout = AdminLayout;
                break;
            case 'Auth':
                page.default.layout = AuthLayout;
                break;
        }

        return page;
    },
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(ZiggyVue)
            .use(plugin)
            .use(i18nVue, {
                resolve: async (languageCode) => {
                    const locale = props.initialPage.props.locale;
                    const language = import.meta.glob('../../lang/*.json');
                    return await language[`../../lang/${locale}.json`]();
                },
            })
            .component('font-awesome-icon', FontAwesomeIcon)
            .mount(el);
    },
}).then((response) => {});
