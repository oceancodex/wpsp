import {createInertiaApp} from '@inertiajs/vue3'
import {resolvePageComponent} from "laravel-vite-plugin/inertia-helpers";
import {createApp} from "vue";

createInertiaApp().then(r => {});
console.log('Hello world');