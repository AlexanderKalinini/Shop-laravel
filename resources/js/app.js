import { createApp } from "vue";
import App from "./App.vue";
import router from "./router/router";
import { store } from "./store/store";

createApp(App).use(router).use(store).mount("#app");

//     document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
//         anchor.addEventListener("click", function (e) {
//             e.preventDefault();
//
//             document.querySelector(this.getAttribute("href")).scrollIntoView({
//                 behavior: "smooth",
//             });
//         });
//     });
