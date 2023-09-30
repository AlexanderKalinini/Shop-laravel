<script>
import { RouterLink } from "vue-router";
import HeaderDropdown from "./HeaderDropdown.vue";

export default {
    components: {
        HeaderDropdown,
        RouterLink,
    },
    data() {
        return { dropdownProfile: false };
    },
    methods: {
        openCloseDropdown() {
            this.dropdownProfile = !this.dropdownProfile;
        },
    },
};
</script>
<template>
    <!-- Site header -->
    <header class="header pt-6 xl:pt-12">
        <div class="container">
            <div
                class="header-inner flex items-center justify-between lg:justify-start"
            >
                <div class="header-logo shrink-0">
                    <router-link to="/" rel="home">
                        <img
                            src="/public/images/logo.svg"
                            class="h-[30px] w-[120px] xs:h-[36px] xs:w-[148px] md:h-[50px] md:w-[201px]"
                            alt="Shop"
                        />
                    </router-link>
                </div>
                <!-- /.header-logo -->
                <div
                    class="header-menu ml-8 mr-8 hidden grow items-center gap-8 lg:flex"
                >
                    <form class="hidden gap-3 lg:flex">
                        <input
                            type="search"
                            class="h-12 w-full rounded-lg border border-body/10 bg-white/5 px-4 text-xs text-white shadow-transparent outline-0 transition focus:border-pink focus:shadow-[0_0_0_3px_#EC4176]"
                            placeholder="Поиск..."
                            required
                        />
                        <button
                            type="submit"
                            class="btn btn-pink !h-12 w-12 shrink-0 !px-0"
                        >
                            <svg
                                class="h-4 w-4"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor"
                                viewBox="0 0 52 52"
                            >
                                <path
                                    d="M50.339 47.364 37.963 34.492a20.927 20.927 0 0 0 4.925-13.497C42.888 9.419 33.47 0 21.893 0 10.317 0 .898 9.419.898 20.995S10.317 41.99 21.893 41.99a20.77 20.77 0 0 0 12.029-3.8l12.47 12.97c.521.542 1.222.84 1.973.84.711 0 1.386-.271 1.898-.764a2.742 2.742 0 0 0 .076-3.872ZM21.893 5.477c8.557 0 15.518 6.961 15.518 15.518s-6.96 15.518-15.518 15.518c-8.556 0-15.518-6.961-15.518-15.518S13.337 5.477 21.893 5.477Z"
                                />
                            </svg>
                        </button>
                    </form>
                    <nav class="hidden gap-8 2xl:flex">
                        <router-link
                            to="/"
                            class="font-bold text-white hover:text-pink"
                            >Главная</router-link
                        >
                        <router-link
                            to="#"
                            class="font-bold text-white hover:text-pink"
                            >Каталог товаров</router-link
                        >
                        <router-link
                            to="#"
                            class="font-bold text-white hover:text-pink"
                            >Корзина</router-link
                        >
                    </nav>
                </div>
                <!-- /.header-menu -->
                <div class="header-actions flex items-center gap-3 md:gap-5">
                    <router-link
                        to="login"
                        class="profile hidden items-center xs:flex"
                    >
                        <svg
                            class="profile-icon h-8 w-8 text-purple"
                            xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink"
                            aria-hidden="true"
                            role="img"
                            width="1em"
                            height="1em"
                            preserveAspectRatio="xMidYMid meet"
                            viewBox="0 0 32 32"
                        >
                            <defs />
                            <path
                                d="M26.749 24.93A13.99 13.99 0 1 0 2 16a13.899 13.899 0 0 0 3.251 8.93l-.02.017c.07.084.15.156.222.239c.09.103.187.2.28.3c.28.304.568.596.87.87c.092.084.187.162.28.242c.32.276.649.538.99.782c.044.03.084.069.128.1v-.012a13.901 13.901 0 0 0 16 0v.012c.044-.031.083-.07.128-.1c.34-.245.67-.506.99-.782c.093-.08.188-.159.28-.242c.302-.275.59-.566.87-.87c.093-.1.189-.197.28-.3c.071-.083.152-.155.222-.24zM16 8a4.5 4.5 0 1 1-4.5 4.5A4.5 4.5 0 0 1 16 8zM8.007 24.93A4.996 4.996 0 0 1 13 20h6a4.996 4.996 0 0 1 4.993 4.93a11.94 11.94 0 0 1-15.986 0z"
                                fill="currentColor"
                            />
                        </svg>
                        <span
                            class="profile-text relative ml-2 text-xxs font-bold text-white md:text-xs"
                            >Войти</span
                        >
                    </router-link>

                    <div class="profile relative" v-if="false">
                        <button
                            @click="openCloseDropdown()"
                            class="flex items-center text-white transition hover:text-pink"
                        >
                            <span class="sr-only">Профиль</span>
                            <img
                                src="/public/storage/images/avatar.jpg"
                                class="h-7 w-7 shrink-0 rounded-full md:h-9 md:w-9"
                                alt="Александр Калинин"
                            />
                            <span class="ml-2 hidden font-medium md:block"
                                >Александр</span
                            >
                            <svg
                                class="ml-2 h-3 w-3 shrink-0"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor"
                                viewBox="0 0 30 16"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M27.536.72a2 2 0 0 1-.256 2.816l-12 10a2 2 0 0 1-2.56 0l-12-10A2 2 0 1 1 3.28.464L14 9.397 24.72.464a2 2 0 0 1 2.816.256Z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </button>
                        <transition
                            @click="openCloseDropdown"
                            enter-from-class="opacity-0"
                            enter-active-class="ease-out duration-500"
                            enter-to-class="opacity-100"
                            leave-active-class="ease-in duration-150"
                            leave-from-class="opacity-100"
                            leave-to-class="opacity-0"
                        >
                            <HeaderDropdown v-if="dropdownProfile" />
                        </transition>
                    </div>
                    <router-link
                        to="cart.html"
                        class="flex items-center gap-3 text-pink hover:text-white"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-6 w-6 md:h-7 md:w-7"
                            fill="currentColor"
                            viewBox="0 0 52 52"
                        >
                            <path
                                d="M26 0a10.4 10.4 0 0 0-10.4 10.4v1.733h-1.439a5.668 5.668 0 0 0-5.668 5.408L7.124 46.055A5.685 5.685 0 0 0 12.792 52h26.416a5.686 5.686 0 0 0 5.668-5.945l-1.37-28.514a5.668 5.668 0 0 0-5.667-5.408H36.4V10.4A10.4 10.4 0 0 0 26 0Zm-6.933 10.4a6.934 6.934 0 0 1 13.866 0v1.733H19.067V10.4Zm-2.843 8.996a1.734 1.734 0 1 1 3.468 0 1.734 1.734 0 0 1-3.468 0Zm16.085 0a1.733 1.733 0 1 1 3.467 0 1.733 1.733 0 0 1-3.467 0Z"
                            />
                        </svg>
                        <div class="hidden flex-col gap-2 sm:flex">
                            <span class="text-xxs leading-none text-body"
                                >3 шт.</span
                            >
                            <span
                                class="text-xxs font-bold !leading-none text-white 2xl:text-xs"
                                >57 900 ₽</span
                            >
                        </div>
                    </router-link>
                    <button
                        id="burgerMenu"
                        class="flex text-white transition hover:text-pink 2xl:hidden"
                    >
                        <span class="sr-only">Меню</span>
                        <svg
                            class="h-8 w-8"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            ></path>
                        </svg>
                    </button>
                </div>
                <!-- /.header-actions -->
            </div>
            <!-- /.header-inner -->
        </div>
        <!-- /.container -->
    </header>
</template>
