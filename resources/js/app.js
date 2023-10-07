import { createApp } from "vue";
import App from "./App.vue";
import router from "./router/router";
import { store } from "./store/store";

createApp(App).use(router).use(store).mount("#app");

document.addEventListener("DOMContentLoaded", function () {
    const burgerMenu = document.querySelector("#burgerMenu");
    const mobileMenu = document.querySelector("#mobileMenu");
    const mobileMenuNavLink = mobileMenu.querySelectorAll("nav > a");
    const closeMobileMenu = document.querySelector("#closeMobileMenu");

    function toggleMobileMenu() {
        mobileMenu.classList.toggle("hidden");
    }

    burgerMenu.addEventListener("click", function (event) {
        console.log("");
        toggleMobileMenu();
    });

    closeMobileMenu.addEventListener("click", function (event) {
        toggleMobileMenu();
    });

    mobileMenuNavLink.forEach(function (el) {
        el.addEventListener("click", function (event) {
            toggleMobileMenu();
        });
    });

    const accordionHeader = document.querySelectorAll(".accordion-header");

    accordionHeader.forEach((header) => {
        header.addEventListener("click", function () {
            const accordionContent =
                header.parentElement.querySelector(".accordion-content");
            // let accordionMaxHeight = accordionContent.style.maxHeight;

            // Condition handling
            if (accordionContent.classList.contains("hidden")) {
                accordionContent.classList.remove("hidden");
                header.classList.add("_is-toggled");
            } else {
                accordionContent.classList.add("hidden");
                header.classList.remove("_is-toggled");
            }
        });
    });

    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
            e.preventDefault();

            document.querySelector(this.getAttribute("href")).scrollIntoView({
                behavior: "smooth",
            });
        });
    });
});
