import { createApp } from "vue";
import App from "./App.vue";
import router from "./router/router";
import { store } from "./store/store";
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

const app = createApp(App);

app.use(Toast, {
    transition: "Vue-Toastification__bounce",
    maxToasts: 5,
    newestOnTop: true,
})
    .use(router)
    .use(store)
    .mount("#app");
