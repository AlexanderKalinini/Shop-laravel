import NotFound from "../Pages/404.vue";
import CartPage from "../Pages/CartPage.vue";
import CatalogPage from "../Pages/CatalogPage/CatalogPage.vue";
import CheckoutPage from "../Pages/CheckoutPage.vue";
import EditProfile from "../Pages/EditProfilePage.vue";
import HomePage from "../Pages/HomePage/HomePage.vue";
import LoginOnMailPage from "../Pages/LoginOnMailPage.vue";
import LoginPage from "../Pages/LoginPage.vue";
import LostPasswordPage from "../Pages/LostPasswordPage.vue";
import OrderSuccessPage from "../Pages/OrderSuccessPage.vue";
import OrdersItemPage from "../Pages/OrdersItemPage.vue";
import OrderPage from "../Pages/OrdersPage.vue";
import Product from "../Pages/ProductPage/ProductPage.vue";
import ResetPasswordPage from "../Pages/ResetPasswordPage.vue";
import SearchPage from "../Pages/SearchPage.vue";
import SignUpPage from "../Pages/SignUpPage.vue";
import SignUpMailPage from "../Pages/SugnUpMailPage.vue";
import FavoritPage from "../Pages/FavoritPage.vue";
import { getCart } from "../../helpers/Cart";

const routes = [
    {
        path: "/",
        component: HomePage,
        name: "home",
    },
    {
        path: "/login",
        component: LoginPage,
        name: "login",
    },
    {
        path: "/login-mail",
        component: LoginOnMailPage,
        name: "login.mail",
    },
    {
        path: "/sign-up",
        component: SignUpPage,
        name: "signup",
    },
    {
        path: "/sign-up-mail",
        component: SignUpMailPage,
        name: "signup.mail",
    },
    {
        path: "/lost-password",
        component: LostPasswordPage,
        name: "lost.password",
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
        path: "/cart",
        component: CartPage,
        name: "cart",
        beforeEnter: (to, from, next) => {
            if (sessionStorage.getItem("cart")) next();
            else next({ name: "catalog" });
        },
    },
    {
        path: "/catalog",
        component: CatalogPage,
        name: "catalog",
    },
    {
        path: "/checkout",
        component: CheckoutPage,
        name: "checkout",
        beforeEnter: (to, from, next) => {
            if (sessionStorage.getItem("cart")) next();
            else next({ name: "catalog" });
        },
    },
    {
        path: "/edit-profile",
        component: EditProfile,
        name: "edit.profile",
    },
    {
        path: "/orders",
        component: OrderPage,
        name: "orders",
    },
    {
        path: "/product/:slug",
        component: Product,
        name: "product",
        props: true,
    },
    {
        path: "/order-items/:id",
        component: OrdersItemPage,
        name: "order.items",
        props: true,
    },
    {
        path: "/search",
        component: SearchPage,
        name: "search",
    },
    {
        path: "/order-success/:id",
        component: OrderSuccessPage,
        name: "order.success",
        props: true,
    },
    {
        path: "/favorit",
        component: FavoritPage,
        name: "favorit",
    },
    {
        path: "/:pathMatch(.*)*",
        component: NotFound,
        name: "notfound",
    },
];

export default routes;
