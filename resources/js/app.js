import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import Layout from './Layout/App.vue';

InertiaProgress.init();

createInertiaApp({
    resolve: name => {
        return import(/* @vite-ignore */`./${name}.vue`).then((page) => {
            page.default.layout = Layout;
            return page;
        });
    },
    setup({ el, App, props }) {
        createApp({ render: () => h(App, props) }).mount(el);
    },
});
