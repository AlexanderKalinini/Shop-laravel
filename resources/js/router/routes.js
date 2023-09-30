import HomePage from "../Pages/HomePage.vue";
import LoginOnMail from "../Pages/LoginOnMailPage.vue";
import LoginPage from "../Pages/LoginPage.vue";

const routes = [
    {
        path: "/",
        component: HomePage,
    },

    {
        path: "/login",
        component: LoginPage,
    },
    {
        path: "/login-mail",
        component: LoginOnMail,
    },
];

export default routes;
