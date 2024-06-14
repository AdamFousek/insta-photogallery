import "./bootstrap";
import router from "./router";
import { createApp } from "vue";
import { createPinia } from 'pinia'

import App from "./App.vue";

const pinia = createPinia()

createApp(App)
    .use(pinia)
    .use(router)
    .mount("#app");