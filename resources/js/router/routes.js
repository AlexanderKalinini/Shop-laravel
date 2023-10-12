import NotFound from "../Pages/404.vue";
import HomePage from "../Pages/HomePage.vue";
import LoginOnMailPage from "../Pages/LoginOnMailPage.vue";
import LoginPage from "../Pages/LoginPage.vue";
import LostPasswordPage from "../Pages/LostPasswordPage.vue";
import ResetPasswordPage from "../Pages/ResetPasswordPage.vue";
import SignUpPage from "../Pages/SignUpPage.vue";
import SignUpMailPage from "../Pages/SugnUpMailPage.vue";

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
        component: LoginOnMailPage,
    },
    {
        path: "/sign-up",
        component: SignUpPage,
    },
    {
        path: "/sign-up-mail",
        component: SignUpMailPage,
    },
    {
        path: "/lost-password",
        component: LostPasswordPage,
    },
    {
        path: "/reset-password",
        component: ResetPasswordPage,
        props: (route) => ({
            token: route.query.token,
            email: route.query.email,
        }),
        name: "password.reset",
    },
    {
        path: "/:pathMatch(.*)*",
        component: NotFound,
    },
];

export default routes;
